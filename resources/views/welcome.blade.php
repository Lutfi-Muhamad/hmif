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

        @keyframes slide-in-down {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-in-up {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .animate-slide-in-down {
            animation: slide-in-down 0.8s ease-out forwards;
        }

        .animate-slide-in-up {
            animation: slide-in-up 0.8s ease-out forwards;
            animation-delay: 0.2s;
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }

        /* Responsive fixes */
        @media (max-width: 640px) {

            /* Small device styles */
            .hero-container {
                min-height: 400px;
            }

            .hero-text {
                padding: 1rem;
                margin-top: -2rem;
            }

            /* Fix buttons spacing */
            .hero-buttons {
                flex-direction: column;
                gap: 0.75rem;
                width: 100%;
                max-width: 300px;
                margin: 0 auto;
            }

            /* Make cards more readable on mobile */
            .card-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Hero image container needs minimum height */
        .hero-image-container {
            min-height: 450px;
            position: relative;
        }

        /* Fix for text over image */
        .text-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            z-index: 10;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.75));
        }

        @media (max-width: 568px) {

            /* Make the hero container bigger */
            .w-full.relative[aria-labelledby="welcome-heading"] {
                min-height: 100vh;
            }

            /* Set the image to fit within container without cropping */
            .w-full.relative[aria-labelledby="welcome-heading"] img {
                object-fit: contain !important;
                /* Forces image to show completely */
                object-position: center !important;
                /* Centers the image */
                max-height: 100vh;
                padding: 0 !important;
            }

            /* Darker overlay for readability since image is smaller */
            .absolute.inset-0.flex.items-center {
                background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.9)) !important;
            }

            .w-full.relative[aria-labelledby="welcome-heading"] img {
                object-position: center center !important;
                /* Focus on center where people usually are */
            }

            .hero-section>div {
                min-height: 100vh;
                /* Increase height for mobile to allow more repeat */
            }

            .hero-section .bg-contain {
                background-size: contain;
                /* Ensure image fits width */
                background-position: top center;
            }
        }

        .absolute.inset-0.flex.items-center.justify-center.bg-gradient-to-b {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.85));
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Hero Section Without Buttons -->
    <div class="w-full relative" aria-labelledby="welcome-heading">
        <div class="w-full relative overflow-hidden" style="min-height: 85vh;">
            <img src="{{ asset('images/fotohmif.jpg') }}"
                class="w-full h-full object-contain md:object-cover absolute inset-0 bg-repeat-y" alt="HMIF Photo">
        </div>

        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-b from-black/75 to-black/85">
            <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16 w-full text-center py-16">
                <div class="flex flex-col gap-6 items-center justify-center w-full">
                    <div class="overflow-hidden">
                        <h1 id="welcome-heading"
                            class="text-white text-4xl md:text-5xl lg:text-7xl leading-tight tracking-tight font-extrabold animate-slide-in-down"
                            style="text-shadow: 0px 4px 8px rgba(0,0,0,0.5); letter-spacing: -0.03em;">
                            <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-blue-300 to-blue-500">HMIF
                                2025</span>
                        </h1>
                    </div>
                    <p class="text-white text-lg md:text-xl lg:text-3xl leading-snug font-semibold animate-slide-in-up bg-black/50 p-4 md:p-6 rounded-xl border-t-4 border-blue-400 shadow-2xl max-w-lg mx-auto"
                        style="text-shadow: 0px 2px 4px rgba(0,0,0,0.4); letter-spacing: 0.02em;">
                        <span class="text-blue-200 italic">KABINET ANVESANA</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="w-full bg-gray-100" aria-labelledby="about-heading">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16 py-16 md:py-20 lg:py-28">
            <div class="flex flex-col lg:flex-row gap-12 md:gap-16 lg:gap-20 items-center">
                <div class="flex flex-col gap-4 md:gap-6 items-start justify-start w-full lg:w-1/2">
                    <h2 id="about-heading"
                        class="text-black text-3xl md:text-4xl lg:text-[40px] leading-[120%] tracking-[-0.01em] font-normal">
                        About HMIF
                    </h2>
                    <p class="text-black text-base md:text-lg leading-[150%] font-normal">
                        HMIF is dedicated to fostering a vibrant community of informatics students. We organize workshops,
                        seminars, and networking events to help members develop their skills and connect with industry
                        professionals.
                    </p>
                </div>
                <img src="{{ asset('images/temptest.jpeg') }}" alt="About HMIF"
                    class="rounded-2xl w-full lg:w-1/2 h-auto md:h-[400px] lg:h-[640px] object-cover">
            </div>
        </div>
    </div>


    {{-- Event section --}}
    <div class="w-full bg-gray-100" aria-labelledby="upcoming-events-heading">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16 py-16 md:py-20 lg:py-28">
            <div class="flex flex-col gap-4 items-center justify-start w-full md:w-[768px] mx-auto mb-12 md:mb-20">
                <span class="text-blue-600 text-center text-base leading-[150%] font-semibold">Upcoming Events</span>
                <h2 id="upcoming-events-heading"
                    class="text-gray-800 text-center text-3xl md:text-4xl lg:text-[48px] leading-[120%] tracking-[-0.01em] font-normal">
                    Events
                </h2>
                <p class="text-gray-600 text-center text-base md:text-lg leading-[150%] font-normal">
                    Join our upcoming events and expand your knowledge
                </p>
            </div>

            <!-- Filter Buttons -->
            <div class="flex justify-center mb-10">
                <div class="overflow-x-auto w-full max-w-md mx-auto">
                    <div class="flex flex-wrap justify-center gap-2 p-2 bg-white rounded-full shadow-sm">
                        <button onclick="filterEvents(null)"
                            class="px-3 py-2 rounded-full text-sm font-medium text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 transition-all duration-200">
                            Semua Event
                        </button>
                        <button onclick="filterEvents('A')"
                            class="px-3 py-2 rounded-full text-sm font-medium text-gray-500 hover:text-white hover:bg-gradient-to-r hover:from-blue-400 hover:to-blue-500 transition-all duration-200">
                            LOMBA
                        </button>
                        <button onclick="filterEvents('B')"
                            class="px-3 py-2 rounded-full text-sm font-medium text-gray-500 hover:text-white hover:bg-gradient-to-r hover:from-blue-400 hover:to-blue-500 transition-all duration-200">
                            WEBINAR
                        </button>
                        <button onclick="filterEvents('C')"
                            class="px-3 py-2 rounded-full text-sm font-medium text-gray-500 hover:text-white hover:bg-gradient-to-r hover:from-blue-400 hover:to-blue-500 transition-all duration-200">
                            MEETUP
                        </button>
                    </div>
                </div>
            </div>


            <!-- Improved Event Grid -->
            <div id="event-list" class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 max-w-5xl mx-auto px-4">
                @include('components.event-cards', ['events' => $events])
            </div>
            <div class="mb-16"> {{-- Tambah margin-bottom besar --}}
                <x-full-calendar :events="$calendarEvents" />
            </div>
        </div>
    </div>


    {{-- Articles section --}}
    <div class="w-full bg-gray-100" aria-labelledby="recent-events-heading">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16 py-16 md:py-20 lg:py-28">
            <div class="flex flex-col gap-4 items-start justify-start w-full md:w-[768px] mb-12 md:mb-20">
                <span class="text-gray-600 text-base leading-[150%] font-semibold">Recent Articles</span>
                <h2 id="recent-events-heading"
                    class="text-gray-800 text-3xl md:text-4xl lg:text-[48px] leading-[120%] tracking-[-0.01em] font-normal">
                    Latest Articles
                </h2>
            </div>
            <div class="w-full">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    {{-- Loop untuk menampilkan artikel --}}
                    @foreach ($articles as $article)
                        <a href="{{ route('articles.detail', $article->id) }}"
                            class="bg-white rounded-2xl shadow-md overflow-hidden transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg block">
                            @if ($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            <div class="p-6">
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <h4 class="text-xl md:text-2xl font-semibold text-gray-800">{{ $article->title }}</h4>
                                    <span
                                        class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Artikel</span>
                                </div>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-500 mb-4">
                                    <span>{{ \Carbon\Carbon::parse($article->created_at)->format('d M Y') }}</span>
                                    <span>•</span>
                                    <span>{{ \Carbon\Carbon::parse($article->created_at)->format('H:i') }}</span>
                                </div>

                                <p class="text-gray-600 text-sm md:text-base">
                                    {{ Str::limit($article->content, 150) }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="w-full bg-gray-100" aria-labelledby="testimonial-heading">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16 py-16 md:py-20 lg:py-28">
            <div class="flex flex-col gap-8 items-center justify-start w-full max-w-3xl mx-auto">
                <!-- Logo HMIF -->
                <img src="{{ asset('images/LOGO_HMIF.png') }}" alt="HMIF Logo"
                    class="w-[160px] md:w-[200px] lg:w-[240px] h-auto object-contain">

                <!-- Testimonial Quote -->
                <blockquote id="testimonial-heading"
                    class="text-gray-800 text-center text-xl md:text-2xl leading-relaxed font-medium italic">
                    "HMIF has been instrumental in my growth as a developer. The workshops and networking events have opened
                    many doors for me."
                </blockquote>

                <!-- Author Info -->
                <div class="flex flex-col items-center gap-3">
                    <img src="{{ asset('images/avatar.png') }}" alt="Testimonial by Jane Smith"
                        class="w-14 h-14 md:w-16 md:h-16 object-cover rounded-full border-2 border-gray-300 shadow-sm">
                    <div class="text-center">
                        <p class="text-gray-800 text-lg font-semibold">Jane Smith</p>
                        <p class="text-gray-600 text-sm">Software Engineer at Tech Corp</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full bg-gray-100" aria-labelledby="why-join-heading">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16 py-16 md:py-20 lg:py-28">
            <h2 id="why-join-heading"
                class="text-gray-800 text-center text-3xl md:text-4xl lg:text-[40px] leading-[120%] tracking-[-0.01em] font-normal w-full mx-auto mb-12 md:mb-20">
                Why Join HMIF?
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12">
                <!-- Card 1 -->
                <div
                    class="bg-white rounded-xl shadow-md p-8 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg">
                    <div class="flex justify-center mb-4">
                        <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
                        </svg>
                    </div>
                    <h3 class="text-gray-800 text-xl md:text-2xl font-semibold mb-3">Networking Opportunities</h3>
                    <p class="text-gray-600 text-sm md:text-base mb-5">
                        Connect with industry professionals and fellow students to build valuable connections.
                    </p>
                    <a href="#"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200 font-medium">
                        Learn More
                        <svg class="w-5 h-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white rounded-xl shadow-md p-8 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg">
                    <div class="flex justify-center mb-4">
                        <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z" />
                        </svg>
                    </div>
                    <h3 class="text-gray-800 text-xl md:text-2xl font-semibold mb-3">Educational Programs</h3>
                    <p class="text-gray-600 text-sm md:text-base mb-5">
                        Access workshops, seminars, and resources to enhance your skills and stay ahead.
                    </p>
                    <a href="#"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200 font-medium">
                        Learn More
                        <svg class="w-5 h-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white rounded-xl shadow-md p-8 text-center transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg">
                    <div class="flex justify-center mb-4">
                        <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                        </svg>
                    </div>
                    <h3 class="text-gray-800 text-xl md:text-2xl font-semibold mb-3">Community</h3>
                    <p class="text-gray-600 text-sm md:text-base mb-5">
                        Be part of a supportive community of like-minded students and professionals.
                    </p>
                    <a href="#"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200 font-medium">
                        Learn More
                        <svg class="w-5 h-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full bg-gray-100" aria-labelledby="join-heading">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16 py-16 md:py-20 lg:py-28">
            <div class="flex flex-col lg:flex-row gap-12 md:gap-16 lg:gap-20 items-center">
                <!-- Text Section -->
                <div class="flex flex-col gap-6 md:gap-8 items-start justify-start w-full lg:w-1/2">
                    <div class="bg-white rounded-xl shadow-md p-8 transform transition-all duration-300 hover:shadow-lg">
                        <h2 id="join-heading"
                            class="text-gray-800 text-3xl md:text-4xl lg:text-[40px] leading-[120%] tracking-[-0.01em] font-normal mb-4">
                            Ready to Join?
                        </h2>
                        <p class="text-gray-600 text-base md:text-lg leading-[150%] font-normal mb-6">
                            Become a part of our community and start your journey with HMIF today.
                        </p>
                        <a href="/registrasi"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200 font-medium">
                            Join Now
                            <svg class="w-5 h-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Image Section -->
                <div class="w-full lg:w-1/2">
                    <div
                        class="rounded-2xl overflow-hidden shadow-lg transform transition-transform duration-300 hover:scale-[1.02]">
                        <img src="{{ asset('images/temptest.jpeg') }}" alt="Join HMIF"
                            class="w-full h-[250px] md:h-[300px] lg:h-[400px] object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>





    {{-- untuk filter --}}
    <script>
        function filterEvents(category) {
            let url = "{{ route('events.filter') }}";
            if (category) {
                url += '?category=' + category;
            }

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('event-list').innerHTML = data.html;
                })
                .catch(err => {
                    console.error('Error:', err);
                });
        }

        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (toggleButton && passwordInput) {
                toggleButton.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    // Change icon
                    const iconClass = type === 'password' ? 'fa-eye' : 'fa-eye-slash';
                    toggleButton.innerHTML = `<i class="fas ${iconClass}"></i>`;
                });
            }

            // Show login modal if redirected from login page
            if (@json(session()->has('show_login_modal'))) {
                const loginModal = document.getElementById('loginModal');
                if (loginModal) {
                    loginModal.classList.remove('hidden');
                }
            }

            // Close login modal
            const closeLoginBtn = document.getElementById('closeLoginModal');
            if (closeLoginBtn) {
                closeLoginBtn.addEventListener('click', function() {
                    document.getElementById('loginModal').classList.add('hidden');
                });
            }

            // Close modal when clicking outside
            const loginModal = document.getElementById('loginModal');
            if (loginModal) {
                loginModal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.add('hidden');
                    }
                });
            }
        });
    </script>
@endsection
