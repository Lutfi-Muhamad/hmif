<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan artikel dan event
     */
    public function index()
    {
        // Ambil 6 artikel terbaru
        $articles = Article::latest()->take(6)->get();
        
        // Ambil event yang akan datang (upcoming) dan sedang berlangsung (ongoing) untuk grid
        $events = Event::whereIn('status', ['upcoming', 'ongoing'])
            ->orderBy('event_date', 'asc')
            ->take(4)
            ->get();

        // Ambil SEMUA event untuk kalender dari database
        $calendarEvents = Event::orderBy('event_date', 'asc')->get()->map(function($event) {
            return [
                'id' => 'event_' . $event->id,
                'title' => $event->title,
                'start' => $event->event_date,
                'end' => $event->event_date,
                'url' => route('events.detail', $event->id),
                'color' => $this->getEventColor($event->category),
                'textColor' => '#ffffff',
                'extendedProps' => [
                    'type' => 'hmif_event',
                    'status' => $event->status,
                    'location' => $event->location,
                    'category' => $event->category,
                ],
            ];
        })->toArray();

        // Ambil hari libur dari Google Calendar (cached untuk 1 hari)
        $holidays = Cache::remember('google_holidays', 60 * 24, function () {
            return $this->getGoogleHolidays();
        });

        // Gabungkan event dan hari libur
        $allCalendarEvents = array_merge($calendarEvents, $holidays);

        return view('welcome', compact('articles', 'events', 'allCalendarEvents'));
    }

    /**
     * Get holidays from Google Calendar API
     */
    private function getGoogleHolidays()
{
    try {
        $apiKey = "AIzaSyDOtGM5jr8bNp1utVpG2_gSRH03RNGBkI8";
        
        if (!$apiKey) {
            Log::warning('Google API Key not found, using fallback holidays');
            return $this->getFallbackHolidays();
        }

        $calendarIds = [
            'en.indonesian#holiday@group.v.calendar.google.com',
            'id.indonesian#holiday@group.v.calendar.google.com',
            'indonesian__id@holiday.calendar.google.com'
        ];

        $baseUrl = 'https://www.googleapis.com/calendar/v3';
        $params = [
            'key' => $apiKey,
            'timeMin' => now()->startOfYear()->toISOString(),
            'timeMax' => now()->endOfYear()->toISOString(),
            'singleEvents' => 'true',
            'orderBy' => 'startTime',
            'maxResults' => 50,
            'timeZone' => 'Asia/Jakarta'
        ];

        foreach ($calendarIds as $calendarId) {
            $response = Http::timeout(15)->retry(2, 1000)
                ->get("{$baseUrl}/calendars/" . urlencode($calendarId) . "/events", $params);

            if ($response->successful()) {
                $data = $response->json();
                
                if (!empty($data['items'])) {
                    Log::info("Holidays fetched from: {$calendarId}");
                    
                    // Format events langsung di sini
                    $holidays = [];
                    foreach ($data['items'] as $event) {
                        $start = $event['start'];
                        $date = $start['date'] ?? substr($start['dateTime'], 0, 10);
                        
                        // Skip old events
                        if (Carbon::parse($date)->lt(now()->subMonth())) continue;
                        
                        $title = trim($event['summary']);
                        
                        // Add emoji dan color logic langsung
                        $emoji = '🎉';
                        $color = '#dc2626';
                        
                        if (stripos($title, 'cuti') !== false) {
                            $emoji = '📅'; $color = '#f59e0b';
                        } elseif (stripos($title, 'tahun baru') !== false) {
                            $emoji = '🎊';
                        } elseif (stripos($title, 'natal') !== false) {
                            $emoji = '🎄';
                        } elseif (stripos($title, 'idul') !== false) {
                            $emoji = stripos($title, 'fitri') !== false ? '🌙' : '🕌';
                            $color = '#16a34a';
                        } elseif (stripos($title, 'kemerdekaan') !== false) {
                            $emoji = '🇮🇩';
                        } elseif (stripos($title, 'buruh') !== false) {
                            $emoji = '⚒️';
                        } elseif (stripos($title, 'pancasila') !== false) {
                            $emoji = '🌟';
                        } elseif (stripos($title, 'waisak') !== false) {
                            $emoji = '🏮';
                        } elseif (stripos($title, 'nyepi') !== false) {
                            $emoji = '🕯️';
                        } elseif (stripos($title, 'paskah') !== false) {
                            $emoji = '🐣';
                        }
                        
                        $holidays[] = [
                            'id' => 'holiday_' . $event['id'],
                            'title' => $emoji . ' ' . $title,
                            'start' => $date,
                            'allDay' => true,
                            'color' => $color,
                            'textColor' => '#ffffff',
                            'display' => 'background',
                            'extendedProps' => [
                                'type' => 'holiday',
                                'status' => 'holiday',
                                'description' => $event['description'] ?? 'Hari Libur Nasional',
                                'source' => 'google_calendar'
                            ]
                        ];
                    }
                    
                    return $holidays;
                }
            } else {
                Log::warning("Failed calendar {$calendarId}: " . $response->status());
            }
        }
        
        return $this->getFallbackHolidays();
        
    } catch (\Exception $e) {
        Log::error('Google Calendar API Error: ' . $e->getMessage());
        return $this->getFallbackHolidays();
    }
}

// Caching method (keep this karena berguna)
private function getCachedHolidays()
{
    return Cache::remember('google_holidays_' . now()->year, now()->addDays(7), function () {
        return $this->getGoogleHolidays();
    });
}
    /**
     * Get event color based on category
     */
    private function getEventColor($category)
    {
        return match($category) {
            'A' => '#3b82f6', // Blue for LOMBA
            'B' => '#10b981', // Green for WEBINAR  
            'C' => '#f59e0b', // Yellow for MEETUP
            default => '#6b7280' // Gray for others
        };
    }
    
    /**
     * Menampilkan detail artikel
     */
    public function showArticle($id)
    {
        $article = Article::findOrFail($id);
        
        // Get related articles (excluding current article)
        $relatedArticles = Article::where('id', '!=', $id)
                                ->latest()
                                ->take(4)
                                ->get();
        
        return view('artikel-detail', compact('article', 'relatedArticles'));
    }

    public function articleIndex(Request $request){
         // Build the query
            $articlesQuery = Article::query()->latest();
            
            // Apply search filter if provided
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $articlesQuery->where(function($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                          ->orWhere('content', 'like', "%{$search}%");
                });
            }
            
            // Apply category filter if provided
            if ($request->has('category') && $request->category != '') {
                $articlesQuery->where('category', $request->category);
            }
            
            // Get paginated results
            $articles = $articlesQuery->paginate(9);
            
            // Return view with data
            return view('artikel', compact('articles'));
    }
        
    /**
     * Filter event berdasarkan kategori via AJAX
     */
    public function filterEvents(Request $request)
    {
        $query = Event::query();
        
        // Filter by category
        $category = $request->query('category');
        if ($category && in_array($category, ['A', 'B', 'C'])) {
            $query->where('category', $category);
        }
        
        // Filter by status (default: upcoming & ongoing)
        $query->whereIn('status', ['upcoming', 'ongoing']);
        
        // Sort by event date (upcoming events first)
        $events = $query->orderBy('event_date', 'asc')->get();

        return response()->json([
            'html' => view('components.event-cards', compact('events'))->render()
        ]);
    }

    /**
     * Display a listing of events.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function events(Request $request)
    {
        // Start with a base query
        $query = Event::query();

        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('detail', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('location', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Apply category filter if provided
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        // Get paginated events
        $events = $query->orderBy('event_date', 'desc')->paginate(9);
        
        // Get featured upcoming events
        $featuredEvents = Event::where('event_date', '>=', Carbon::today())
            ->orderBy('event_date', 'asc')
            ->take(2)
            ->get();

        return view('event', compact('events', 'featuredEvents'));
    }

    /**
     * Display the specified event.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function eventDetail($id)
    {
        $event = Event::findOrFail($id);
        
        // Get related events (same category, excluding current)
        $relatedEvents = Event::where('category', $event->category)
            ->where('id', '!=', $event->id)
            ->orderBy('event_date', 'desc')
            ->take(3)
            ->get();
            
        // Get upcoming events
        $upcomingEvents = Event::where('event_date', '>=', Carbon::today())
            ->where('id', '!=', $event->id)
            ->orderBy('event_date', 'asc')
            ->take(3)
            ->get();
            
        return view('event-detail', compact('event', 'relatedEvents', 'upcomingEvents'));
    }

    /**
     * Show the form for creating a new aspiration.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function aspirasi()
    {
        // Get the 5 most recent resolved aspirations to display on the page
        $recentAspirasi = Aspirasi::where('status', 'resolved')
            ->latest()
            ->take(5)
            ->get();
            
        return view('aspirasi', compact('recentAspirasi'));
    }

    /**
     * Store a newly created aspiration in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAspirasi(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required_without:is_anonymous|string|max:255',
            'aspirasi' => 'required|string|min:10',
            'captcha' => 'required|captcha',
        ], [
            'name.required_without' => 'Nama harus diisi jika tidak mengirim sebagai anonim.',
            'aspirasi.required' => 'Aspirasi tidak boleh kosong.',
            'aspirasi.min' => 'Aspirasi minimal 10 karakter.',
            'captcha.required' => 'Kode captcha harus diisi.',
            'captcha.captcha' => 'Kode captcha tidak valid.'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Create new aspirasi
        $aspirasi = new Aspirasi();
        $aspirasi->name = $request->is_anonymous ? null : $request->name;
        $aspirasi->aspirasi = $request->aspirasi;
        $aspirasi->is_anonymous = $request->has('is_anonymous');
        $aspirasi->status = 'pending';
        $aspirasi->save();
        
        return redirect()->back()->with('success', 'Aspirasi berhasil dikirim! Terima kasih atas masukan Anda.');
    }

    public function detailAspirasi($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        return response()->json($aspirasi); // Return data dalam bentuk JSON agar bisa digunakan di frontend
    }

    public function reloadCaptcha()
    {
        return response()->json([
            'captcha' => captcha_src('math')
        ]);
    }
}