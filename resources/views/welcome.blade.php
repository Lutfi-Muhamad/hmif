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
    </style>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="w-full relative" aria-labelledby="welcome-heading">
        <div class="w-full relative overflow-hidden">
            <img src="{{ asset('images/fotohmif.jpg') }}" class="w-full h-auto" alt="HMIF Photo">
        </div>

        <div class="absolute inset-0 flex items-center bg-gradient-to-b from-black/70 to-black/70">
            <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16 w-full">
                <div class="flex flex-col gap-6 md:gap-8 items-start justify-center w-full md:w-[60%] lg:w-[560px]">
                    <div class="flex flex-col gap-4 md:gap-6 items-start justify-start w-full">
                        <div class="overflow-hidden">
                            <h1 id="welcome-heading"
                                class="text-white text-4xl md:text-5xl lg:text-[60px] leading-[1.1] tracking-tight font-bold animate-fade-in-up"
                                style="text-shadow: 0px 2px 4px rgba(0,0,0,0.3); letter-spacing: -0.02em;">
                                Welcome to <span
                                    class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-blue-500">HMIF</span>
                            </h1>
                        </div>
                        <p class="text-white text-base md:text-lg lg:text-xl leading-[1.7] font-normal max-w-xl animate-fade-in bg-black/30 p-4 md:p-5 rounded-lg border-l-4 border-blue-300 shadow-lg"
                            style="text-shadow: 0px 1px 3px rgba(0,0,0,0.3); letter-spacing: 0.01em;">
                            <span class="text-blue-200 font-medium">Himpunan Mahasiswa Informatika (HMIF)</span> is a
                            student organization that brings together students
                            from the Informatics study program. We organize <span class="text-gray-200 italic">various
                                activities</span> to enhance knowledge, skills,
                            and networking opportunities.
                        </p>
                    </div>
                    <div class="flex flex-row gap-4 items-start animate-fade-in-up" style="animation-delay: 0.3s;">
                        @guest
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"
                                class="group relative overflow-hidden flex flex-row gap-2 items-center justify-center px-5 md:px-7 py-2.5 md:py-3 rounded-full border-solid border-2 border-[#f4efeb] bg-[#f4efeb] text-[#2a2d47] text-sm md:text-base font-semibold hover:text-white transition-all duration-300 shadow-lg hover:shadow-xl">
                                <span class="relative z-10">Join Us</span>
                                <span
                                    class="absolute inset-0 bg-gradient-to-r from-[#136ca9] to-[#0a4c7a] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}"
                                class="group relative overflow-hidden flex flex-row gap-2 items-center justify-center px-5 md:px-7 py-2.5 md:py-3 rounded-full border-solid border-2 border-[#f4efeb] bg-[#f4efeb] text-[#2a2d47] text-sm md:text-base font-semibold hover:text-white transition-all duration-300 shadow-lg hover:shadow-xl">
                                <span class="relative z-10">Go to Dashboard</span>
                                <span
                                    class="absolute inset-0 bg-gradient-to-r from-[#136ca9] to-[#0a4c7a] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                            </a>
                        @endguest
                        <a href="#about"
                            class="group relative overflow-hidden flex flex-row gap-2 items-center justify-center px-5 md:px-7 py-2.5 md:py-3 rounded-full border-solid border-2 border-white bg-transparent backdrop-blur-sm text-white text-sm md:text-base font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                            <span class="relative z-10 group-hover:text-[#2a2d47] transition-colors duration-300">Learn
                                More</span>
                            <span
                                class="absolute inset-0 bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                            <span class="absolute top-0 left-0 w-full h-full bg-[#2a2d47] rounded-full z-0"></span>
                        </a>
                    </div>
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


    {{-- Event backend --}}
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
                <div class="overflow-x-auto flex gap-2 md:gap-4 items-center min-w-max p-1 bg-white rounded-full shadow-sm">
                    <button onclick="filterEvents(null)"
                        class="px-4 py-2 rounded-full text-sm md:text-base font-medium text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 transition-all duration-200">
                        View All
                    </button>
                    <button onclick="filterEvents('A')"
                        class="px-4 py-2 rounded-full text-sm md:text-base font-medium text-gray-500 hover:text-white hover:bg-gradient-to-r hover:from-blue-400 hover:to-blue-500 transition-all duration-200">
                        Category A
                    </button>
                    <button onclick="filterEvents('B')"
                        class="px-4 py-2 rounded-full text-sm md:text-base font-medium text-gray-500 hover:text-white hover:bg-gradient-to-r hover:from-blue-400 hover:to-blue-500 transition-all duration-200">
                        Category B
                    </button>
                    <button onclick="filterEvents('C')"
                        class="px-4 py-2 rounded-full text-sm md:text-base font-medium text-gray-500 hover:text-white hover:bg-gradient-to-r hover:from-blue-400 hover:to-blue-500 transition-all duration-200">
                        Category C
                    </button>
                </div>
            </div>



            <div id="event-list" class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10 max-w-5xl mx-auto">
                @include('components.event-cards', ['events' => $events])
            </div>

        </div>
    </div>


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
                        <a href="{{ route('articles.show', $article->id) }}"
                            class="bg-white rounded-2xl shadow-md overflow-hidden transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg block">
                            @if ($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="Image"
                                    class="w-full h-48 object-cover">
                            @endif

                            <div class="p-6">
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <h4 class="text-xl md:text-2xl font-semibold text-gray-800">{{ $article->title }}</h4>
                                    <span
                                        class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Artikel</span>
                                </div>

                                <div class="flex flex-wrap gap-3 text-sm text-gray-500 mb-4">
                                    <span>{{ $article->created_at->format('d M Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $article->created_at->format('H:i') }}</span>
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
                    “HMIF has been instrumental in my growth as a developer. The workshops and networking events have opened
                    many doors for me.”
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
                        <a href=""
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

    <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center w-full h-full">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden transform transition-all">
                <!-- Close button -->
                <div class="absolute top-4 right-4">
                    <button id="closeLoginModal" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Modal content -->
                <div class="px-8 pt-8 pb-10">
                    <!-- Logo centered -->
                    <div class="flex justify-center mb-8">
                        <img class="w-24 h-auto object-contain" src="{{ asset('images/LOGO_HMIF.png') }}"
                            alt="HMIF Logo">
                    </div>

                    <!-- Modal title -->
                    <h2 class="text-2xl font-bold text-center text-[#2a2d47] mb-6">Sign In to HMIF</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Show error message if exists -->
                        @if ($errors->has('login_error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                <span>{{ $errors->first('login_error') }}</span>
                            </div>
                        @endif
                        <!-- Email input -->
                        <div class="mb-5">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input type="email" id="email" name="email"
                                    class="pl-10 block w-full rounded-lg border @error('email') border-red-500 @enderror py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#136ca9] focus:border-transparent transition duration-150"
                                    placeholder="your@email.com" value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-1">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>

                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" id="password" name="password"
                                    class="pl-10 block w-full rounded-lg border border-gray-300 py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#136ca9] focus:border-transparent transition duration-150"
                                    placeholder="••••••••" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" id="togglePassword"
                                        class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Remember me checkbox -->
                        <div class="flex items-center mb-6">
                            <input type="checkbox" id="remember" name="remember"
                                class="h-4 w-4 text-[#136ca9] focus:ring-[#136ca9] border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit"
                            class="w-full bg-[#2a2d47] text-white py-3 px-4 rounded-lg font-medium hover:bg-[#136ca9] focus:outline-none focus:ring-2 focus:ring-[#136ca9] focus:ring-opacity-50 transition duration-150 shadow-md flex items-center justify-center">
                            <span>Sign In</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </form>

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
    </script>
@endsection
