@extends('layouts.app')

@section('style')
    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }

        /* Event card hover effects */
        .event-card {
            transition: all 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .event-card .event-image {
            transition: all 0.5s ease;
        }

        .event-card:hover .event-image {
            transform: scale(1.05);
        }

        /* Category badge colors */
        .category-lomba {
            background-color: rgba(239, 68, 68, 0.15);
            color: rgb(185, 28, 28);
        }

        .category-webinar {
            background-color: rgba(16, 185, 129, 0.15);
            color: rgb(4, 120, 87);
        }

        .category-meetup {
            background-color: rgba(79, 70, 229, 0.15);
            color: rgb(67, 56, 202);
        }

        /* Date badge */
        .date-badge {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Status badges */
        .status-upcoming {
            background-color: rgba(79, 70, 229, 0.15);
            color: rgb(67, 56, 202);
        }

        .status-ongoing {
            background-color: rgba(16, 185, 129, 0.15);
            color: rgb(4, 120, 87);
        }

        .status-completed {
            background-color: rgba(107, 114, 128, 0.15);
            color: rgb(75, 85, 99);
        }
    </style>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Events Header Section with Background -->
    <div class="w-full relative mb-8" aria-labelledby="events-heading">
        <div class="w-full relative overflow-hidden h-[250px] md:h-[300px]">
            <div class="w-full h-full bg-gradient-to-r from-indigo-600 to-purple-900"></div>
        </div>

        <!-- Overlay with content -->
        <div class="absolute inset-0 flex items-center bg-gradient-to-b from-black/60 to-black/60">
            <!-- Decorative frame corners -->
            <div class="absolute top-4 left-4 w-12 h-12 border-t-2 border-l-2 border-indigo-300 opacity-80"></div>
            <div class="absolute top-4 right-4 w-12 h-12 border-t-2 border-r-2 border-indigo-300 opacity-80"></div>
            <div class="absolute bottom-4 left-4 w-12 h-12 border-b-2 border-l-2 border-indigo-300 opacity-80"></div>
            <div class="absolute bottom-4 right-4 w-12 h-12 border-b-2 border-r-2 border-indigo-300 opacity-80"></div>

            <!-- Content container -->
            <div class="max-w-5xl mx-auto px-4 md:px-8 lg:px-16 w-full z-10">
                <div class="flex flex-col gap-4 items-center justify-center w-full text-center">
                    <!-- Events Title -->
                    <div class="overflow-hidden">
                        <h1 id="events-heading"
                            class="text-white text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-in-up"
                            style="text-shadow: 0px 2px 4px rgba(0,0,0,0.5); letter-spacing: -0.01em;">
                            Acara HMIF
                        </h1>
                    </div>

                    <!-- Subtitle -->
                    <p class="text-white/90 text-lg md:text-xl max-w-2xl mx-auto animate-fade-in">
                        Kegiatan dan event menarik yang diselenggarakan oleh HMIF
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Events List Section -->
    <div class="w-full bg-gray-100 py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <!-- Search and Filter -->
            <div class="mb-10 flex flex-col md:flex-row justify-between items-center gap-4">
                <!-- Left side: Search -->
                <div class="w-full md:w-auto">
                    <form action="{{ route('events.index') }}" method="GET" class="flex">
                        <div class="relative flex-grow">
                            <input type="text" name="search" placeholder="Cari event..." value="{{ request('search') }}"
                                class="pl-10 pr-4 py-2 w-full md:w-80 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-r-lg transition duration-200">
                            Cari
                        </button>
                    </form>
                </div>

                <!-- Right side: Category Filters -->
                <div class="flex flex-wrap justify-center gap-2">
                    <a href="{{ route('events.index') }}"
                        class="px-4 py-2 rounded-full text-sm font-medium {{ !request('category') ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition duration-200">
                        Semua
                    </a>
                    <a href="{{ route('events.index', ['category' => 'LOMBA']) }}"
                        class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') == 'A' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition duration-200">
                        Lomba
                    </a>
                    <a href="{{ route('events.index', ['category' => 'WEBINAR']) }}"
                        class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') == 'B' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition duration-200">
                        Webinar
                    </a>
                    <a href="{{ route('events.index', ['category' => 'MEETUP']) }}"
                        class="px-4 py-2 rounded-full text-sm font-medium {{ request('category') == 'C' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition duration-200">
                        Meetup
                    </a>
                </div>
            </div>

            <!-- Events Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse ($events as $event)
                    <a href="{{ route('events.detail', $event->id) }}"
                        class="event-card bg-white rounded-xl shadow-md overflow-hidden flex flex-col h-full relative">
                        <!-- Event Image -->
                        <div class="overflow-hidden h-48 relative">
                            @if ($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                    class="event-image w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-r from-indigo-600/80 to-purple-800/80 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-white/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            <!-- Date Badge -->
                            <div class="absolute top-3 left-3 date-badge bg-white rounded-lg p-2 text-center min-w-16">
                                <span class="block text-sm font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d') }}
                                </span>
                                <span class="block text-xs font-medium text-gray-600">
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('M Y') }}
                                </span>
                            </div>

                            <!-- Status Badge -->
                            @php
                                $now = \Carbon\Carbon::now();
                                $eventDate = \Carbon\Carbon::parse($event->event_date);

                                if ($eventDate->isToday()) {
                                    $statusClass = 'status-ongoing';
                                    $statusText = 'Berlangsung';
                                } elseif ($eventDate->isFuture()) {
                                    $statusClass = 'status-upcoming';
                                    $statusText = 'Akan Datang';
                                } else {
                                    $statusClass = 'status-completed';
                                    $statusText = 'Selesai';
                                }
                            @endphp

                            <div
                                class="absolute top-3 right-3 px-2 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                {{ $statusText }}
                            </div>
                        </div>

                        <!-- Event Details -->
                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <!-- Category Badge -->
                                @php
                                    $categoryClass = '';
                                    switch ($event->category) {
                                        case 'A':
                                            $categoryClass = 'category-lomba';
                                            break;
                                        case 'B':
                                            $categoryClass = 'category-webinar';
                                            break;
                                        case 'C':
                                            $categoryClass = 'category-meetup';
                                            break;
                                    }
                                @endphp
                                <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $categoryClass }}">
                                    {{ $event->category_name }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $event->title }}</h3>

                            <!-- Time & Location Info -->
                            <div class="flex flex-col gap-2 text-sm text-gray-600 mb-4">
                                <div class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-gray-500 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    <span>{{ $event->start_time }} - {{ $event->end_time }}</span>
                                </div>

                                <div class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-gray-500 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                        </path>
                                    </svg>
                                    <span>{{ $event->location }}</span>
                                </div>
                            </div>

                            <p class="text-gray-600 text-sm flex-grow mb-4">
                                {{ Str::limit($event->detail, 120) }}
                            </p>

                            <div class="flex justify-end mt-auto">
                                <span
                                    class="inline-flex items-center text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    Lihat detail
                                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-1 md:col-span-3 py-16 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <h3 class="text-xl font-medium text-gray-700 mb-1">Tidak ada event</h3>
                        <p class="text-gray-500">Belum ada event yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $events->links() }}
            </div>
        </div>
    </div>

    <!-- Upcoming Events Section (if any ongoing/upcoming events exist) -->
    @if (isset($featuredEvents) && $featuredEvents->count() > 0)
        <div class="w-full bg-white py-12 md:py-16">
            <div class="max-w-7xl mx-auto px-4 md:px-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8 text-center">Event Mendatang</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($featuredEvents as $featuredEvent)
                        <div class="bg-gray-50 rounded-xl overflow-hidden shadow-md flex flex-col md:flex-row h-full">
                            <!-- Image -->
                            <div class="md:w-2/5 h-48 md:h-auto overflow-hidden">
                                @if ($featuredEvent->image)
                                    <img src="{{ asset('storage/' . $featuredEvent->image) }}"
                                        alt="{{ $featuredEvent->title }}" class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-r from-indigo-600/80 to-purple-800/80 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white/70" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="md:w-3/5 p-6 flex flex-col">
                                <!-- Category -->
                                @php
                                    $categoryClass = '';
                                    switch ($featuredEvent->category) {
                                        case 'A':
                                            $categoryClass = 'category-lomba';
                                            break;
                                        case 'B':
                                            $categoryClass = 'category-webinar';
                                            break;
                                        case 'C':
                                            $categoryClass = 'category-meetup';
                                            break;
                                    }
                                @endphp
                                <span
                                    class="inline-block text-xs font-semibold px-2 py-1 rounded-full {{ $categoryClass }} mb-2 w-max">
                                    {{ $featuredEvent->category_name }}
                                </span>

                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $featuredEvent->title }}</h3>

                                <!-- Date -->
                                <div class="flex items-center gap-2 text-gray-600 text-sm mb-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($featuredEvent->event_date)->format('d F Y') }}</span>
                                </div>

                                <!-- Time -->
                                <div class="flex items-center gap-2 text-gray-600 text-sm mb-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    <span>{{ $featuredEvent->start_time }} - {{ $featuredEvent->end_time }}</span>
                                </div>

                                <!-- Location -->
                                <div class="flex items-center gap-2 text-gray-600 text-sm mb-4">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                        </path>
                                    </svg>
                                    <span>{{ $featuredEvent->location }}</span>
                                </div>

                                <!-- Description -->
                                <p class="text-sm text-gray-600 mb-4 flex-grow">
                                    {{ Str::limit($featuredEvent->detail, 150) }}
                                </p>

                                <!-- CTA Button -->
                                <div class="mt-auto">
                                    <a href="{{ route('events.detail', $featuredEvent->id) }}"
                                        class="inline-block px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition duration-200">
                                        Lihat detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif


@endsection
