<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Untuk halaman admin - index/list events
    public function index(Request $request)
    {
        $query = Event::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('detail', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Sorting by date (default newest first)
        $events = $query->latest()->paginate(10);

        return view('admin.event', compact('events'));
    }

    // Store/create new event
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'category' => 'required|in:LOMBA,WEBINAR,MEETUP',
            'event_date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after_or_equal:start_time',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:upcoming,ongoing,completed,canceled',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'title',
            'detail',
            'category',
            'event_date',
            'start_time',
            'end_time',
            'location',
            'status'
        ]);

        if ($request->hasFile('image')) {
            // Menyimpan gambar ke storage/app/public/events
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->back()->with('success', 'Event berhasil ditambahkan!');
    }

    // Edit event form
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    // Update event
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'category' => 'required|string|max:255',
            'category' => 'required|in:LOMBA,WEBINAR,MEETUP',
            'event_date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after_or_equal:start_time',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:upcoming,ongoing,completed,canceled',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $event = Event::findOrFail($id);

        $event->title = $request->title;
        $event->detail = $request->detail;
        $event->category = $request->category;
        $event->event_date = $request->event_date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->location = $request->location;
        $event->status = $request->status;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            // Upload gambar baru
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->save();

        return redirect()->back()->with('success', 'Event berhasil diperbarui!');
    }

    // Delete event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->back()->with('success', 'Event berhasil dihapus!');
    }

    // Tampilan di halaman utama
    public function showEvents(Request $request)
    {
        $query = Event::query();

        // Filter by category
        $category = $request->query('category');
        if ($category) {
            $query->where('category', $category);
        }

        // Filter by status (default: upcoming & ongoing)
        $status = $request->query('status', ['upcoming', 'ongoing']);
        if (!is_array($status)) {
            $status = [$status];
        }
        $query->whereIn('status', $status);

        // Sort by event date (upcoming events first)
        $events = $query->orderBy('event_date', 'asc')->get();

        // Get recent articles for sidebar if needed
        $articles = Article::latest()->take(5)->get();

        return view('welcome', compact('events', 'articles', 'category'));
    }

    // API untuk filter melalui AJAX
    public function filter(Request $request)
    {
        $query = Event::query();

        // Filter by category
        $category = $request->query('category');
        if ($category) {
            $query->where('category', $category);
        }

        // Filter by status
        $status = $request->query('status', ['upcoming', 'ongoing']);
        if (!is_array($status)) {
            $status = [$status];
        }
        if (!empty($status)) {
            $query->whereIn('status', $status);
        }

        // Sort by date (upcoming first)
        $events = $query->orderBy('event_date', 'asc')->get();

        return response()->json([
            'html' => view('components.event-cards', compact('events'))->render()
        ]);
    }

    // Show single event detail
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event-detail', compact('event'));
    }
}
