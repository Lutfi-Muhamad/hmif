@extends('layouts.app')

{{-- @section('style')
    <style>
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
    </style>
@endsection --}}

@section('content')
    <!-- Event Detail Section -->
    <div class="w-full bg-gray-100 py-8 pt-24 md:pt-32">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('events.index') }}"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">Events</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span
                                class="ml-1 text-sm font-medium text-gray-500 md:ml-2 truncate max-w-xs">{{ $event->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Event Header -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                <!-- Event Image Banner -->
                <div class="relative w-full h-64 md:h-80 overflow-hidden">
                    @if ($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                            class="w-full h-full object-cover">
                    @else
                        <div
                            class="w-full h-full bg-gradient-to-r from-indigo-600 to-purple-900 flex items-center justify-center">
                            <svg class="w-24 h-24 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    @endif
                    <!-- Overlay with title -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent flex flex-col justify-end p-6 md:p-8">
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
                        <span
                            class="inline-block text-xs font-semibold px-3 py-1.5 rounded-full {{ $categoryClass }} mb-3 w-max">
                            {{ $event->category_name }}
                        </span>
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-2"
                            style="text-shadow: 0px 2px 4px rgba(0,0,0,0.3);">
                            {{ $event->title }}
                        </h1>
                    </div>
                </div>

                <!-- Event Info Section -->
                <div class="p-6 md:p-8">
                    <!-- Status and Meta -->
                    <div class="flex flex-wrap justify-between items-center mb-6">
                        <!-- Status Badge -->
                        @php
                            $now = \Carbon\Carbon::now();
                            $eventDate = \Carbon\Carbon::parse($event->event_date);

                            if ($eventDate->isToday()) {
                                $statusClass = 'status-ongoing';
                                $statusText = 'Berlangsung Hari Ini';
                            } elseif ($eventDate->isFuture()) {
                                $statusClass = 'status-upcoming';
                                $statusText = 'Akan Datang';
                            } else {
                                $statusClass = 'status-completed';
                                $statusText = 'Selesai';
                            }
                        @endphp
                        <span class="px-3 py-1.5 rounded-full text-sm font-semibold {{ $statusClass }}">
                            {{ $statusText }}
                        </span>

                        <!-- Share Links -->
                        <div class="flex items-center gap-2 text-gray-500">
                            <span class="text-sm">Bagikan:</span>
                            <a href="#" class="text-gray-500 hover:text-indigo-600" aria-label="Share to Facebook">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600" aria-label="Share to Twitter">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                    </path>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-indigo-600" aria-label="Share to WhatsApp">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M21.35 2.65a11.8 11.8 0 00-16.75 0c-4.63 4.65-4.63 12.15 0 16.8l-2.35 2.35c-.2.2-.2.5 0 .7.1.1.25.15.35.15h5.25c6.35 0 11.5-5.15 11.5-11.5 0-3.15-1.25-6.15-3.5-8.4zm-4.5 14.35c-.4.4-.85.6-1.35.6s-.95-.2-1.35-.6l-2.5-2.5c-.4-.4-.6-.85-.6-1.35s.2-.95.6-1.35l.35-.35c.4-.4.85-.6 1.35-.6s.95.2 1.35.6l.85.85.85-.85c.4-.4.85-.6 1.35-.6s.95.2 1.35.6l.35.35c.4.4.6.85.6 1.35s-.2.95-.6 1.35l-2.5 2.5z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Event Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Left Column: Date & Time -->
                        <div class="bg-gray-50 rounded-lg p-5">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Waktu & Tempat</h2>

                            <!-- Date -->
                            <div class="flex items-start gap-3 mb-3">
                                <div class="bg-indigo-100 p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Tanggal</h3>
                                    <p class="text-base font-medium text-gray-800">
                                        {{ \Carbon\Carbon::parse($event->event_date)->isoFormat('dddd, D MMMM Y') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Time -->
                            <div class="flex items-start gap-3 mb-3">
                                <div class="bg-indigo-100 p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Waktu</h3>
                                    <p class="text-base font-medium text-gray-800">
                                        {{ $event->start_time }} - {{ $event->end_time }} WIB
                                    </p>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="flex items-start gap-3">
                                <div class="bg-indigo-100 p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Lokasi</h3>
                                    <p class="text-base font-medium text-gray-800">
                                        {{ $event->location }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Quick Actions -->
                        <div class="bg-gray-50 rounded-lg p-5">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Info Event</h2>

                            @php
                                $now = \Carbon\Carbon::now();
                                $eventDate = \Carbon\Carbon::parse($event->event_date);

                                // hitung selisih hari dengan pembulatan ke atas supaya misal 0.8 hari jadi 1 hari
                                $daysLeft = $now->diffInDays($eventDate, false); // ini integer, bisa negatif

                                // Kalau ingin menghitung termasuk waktu dan membulatkan ke atas bisa gunakan diffInHours lalu dibagi 24
                                $hoursLeft = $now->diffInHours($eventDate, false);
                                $daysLeftWithDecimal = $hoursLeft / 24;

                                // Bisa juga pakai ceil supaya pembulatan ke atas
                                $daysLeftRounded = (int) ceil($daysLeftWithDecimal);
                            @endphp

                            @if ($daysLeftRounded > 0)
                                <div class="bg-indigo-50 rounded-lg p-3 mb-4 text-center">
                                    <p class="text-sm text-indigo-600 font-medium">Event akan dimulai dalam</p>
                                    <p class="text-2xl font-bold text-indigo-700">{{ $daysLeftRounded }} hari</p>
                                </div>
                            @elseif($daysLeftRounded == 0)
                                <div class="bg-green-50 rounded-lg p-3 mb-4 text-center">
                                    <p class="text-sm text-green-600 font-medium">Event berlangsung</p>
                                    <p class="text-2xl font-bold text-green-700">Hari Ini</p>
                                </div>
                            @else
                                <div class="bg-gray-50 rounded-lg p-3 mb-4 text-center">
                                    <p class="text-sm text-gray-600 font-medium">Event telah selesai</p>
                                    <p class="text-2xl font-bold text-gray-700">{{ abs($daysLeftRounded) }} hari yang lalu
                                    </p>
                                </div>
                            @endif


                            <!-- Action Button -->
                            @if ($daysLeft >= 0)
                                <div class="grid gap-3">
                                    <a href="#"
                                        class="w-full py-3 px-4 bg-indigo-600 text-white text-center font-medium rounded-lg hover:bg-indigo-700 transition duration-200">
                                        Daftar Sekarang
                                    </a>
                                    <a href="#"
                                        class="w-full py-3 px-4 bg-white border border-gray-300 text-gray-700 text-center font-medium rounded-lg hover:bg-gray-50 transition duration-200">
                                        Tambahkan ke Kalender
                                    </a>
                                </div>
                            @else
                                <div class="text-gray-600 text-center italic">
                                    Event ini telah selesai diselenggarakan.
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Event Description -->
                    <div class="prose prose-indigo max-w-none">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Deskripsi Event</h2>
                        <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $event->detail }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related and Upcoming Events Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Related Events -->
                @if ($relatedEvents->count() > 0)
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Event Serupa</h2>
                        <div class="space-y-4">
                            @foreach ($relatedEvents as $relatedEvent)
                                <a href="{{ route('events.detail', $relatedEvent->id) }}"
                                    class="event-card flex bg-white rounded-lg shadow-sm overflow-hidden h-24">
                                    <!-- Image -->
                                    <div class="w-24 h-full overflow-hidden">
                                        @if ($relatedEvent->image)
                                            <img src="{{ asset('storage/' . $relatedEvent->image) }}"
                                                alt="{{ $relatedEvent->title }}"
                                                class="event-image w-full h-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full bg-gradient-to-r from-indigo-600/80 to-purple-800/80 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white/70" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Details -->
                                    <div class="p-3 flex flex-col justify-center flex-grow">
                                        <h3 class="text-sm font-semibold text-gray-800 line-clamp-1 mb-1">
                                            {{ $relatedEvent->title }}</h3>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <span>{{ \Carbon\Carbon::parse($relatedEvent->event_date)->format('d M Y') }}</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ $relatedEvent->category_name }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Upcoming Events -->
                @if ($upcomingEvents->count() > 0)
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Event Mendatang</h2>
                        <div class="space-y-4">
                            @foreach ($upcomingEvents as $upcomingEvent)
                                <a href="{{ route('events.detail', $upcomingEvent->id) }}"
                                    class="event-card flex bg-white rounded-lg shadow-sm overflow-hidden h-24">
                                    <!-- Image -->
                                    <div class="w-24 h-full overflow-hidden">
                                        @if ($upcomingEvent->image)
                                            <img src="{{ asset('storage/' . $upcomingEvent->image) }}"
                                                alt="{{ $upcomingEvent->title }}"
                                                class="event-image w-full h-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full bg-gradient-to-r from-indigo-600/80 to-purple-800/80 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white/70" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Details -->
                                    <div class="p-3 flex flex-col justify-center flex-grow">
                                        <h3 class="text-sm font-semibold text-gray-800 line-clamp-1 mb-1">
                                            {{ $upcomingEvent->title }}</h3>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <span>{{ \Carbon\Carbon::parse($upcomingEvent->event_date)->format('d M Y') }}</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ $upcomingEvent->location }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Back Button -->
            <div class="flex justify-center mb-8">
                <a href="{{ route('events.index') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar Event
                </a>
            </div>
        </div>
    </div>
@endsection
