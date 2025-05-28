<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', 'HMIF - Himpunan Mahasiswa Informatika')
    </title>
    <link rel="icon" href="{{ asset('images/LOGO_HMIF.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Advanced hover animations for navigation links */
        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: #f4efeb;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link.active::before,
        .nav-link:hover::before {
            width: 100%;
        }

        /* Add subtle hover lift effect */
        .nav-link:hover {
            transform: translateY(-2px);
            transition: transform 0.3s ease;
        }

        /* Glowing effect for buttons */
        a.group:hover::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #136ca9, #2a2d47);
            border-radius: 50px;
            z-index: -2;
            filter: blur(8px);
            opacity: 0.4;
            transition: opacity 0.3s ease;
        }

        /* Active page indicator */
        .nav-link.active {
            font-weight: 600;
            position: relative;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #f4efeb;
        }

        html,
        body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
            box-sizing: border-box;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .nav-link.active {
            color: #ffffff;
            background-color: rgba(244, 239, 235, 0.2);
        }
    </style>
    @stack('styles')
</head>

<body class="min-h-screen w-full bg-gray-100">
    <nav class="w-full bg-[#3a6186] shadow-lg fixed top-0 left-0 z-50" aria-label="Main navigation">
        <div
            class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between px-4 md:px-8 lg:px-16 py-4 md:h-[72px]">
            <div class="flex items-center justify-between w-full md:w-auto">
                <div class="flex items-center gap-2 md:gap-6 lg:gap-10">
                    <a href="/" class="relative">
                        <img class="w-[62px] h-auto object-contain" src="{{ asset('images/LOGO_HMIF.png') }}"
                            alt="HMIF Logo">
                    </a>
                    <span class="ml-2 text-white font-bold text-4xl md:hidden">HMIF</span>
                    <div id="desktop-menu" class="hidden md:flex flex-row gap-6 lg:gap-8 items-center">
                        <!-- Home Link -->
                        <a href="{{ route('home') }}"
                            class="nav-link text-white text-base leading-[150%] font-medium relative group px-2 py-1 overflow-hidden {{ request()->is('/') ? 'active' : '' }}">
                            <span
                                class="relative z-10 transition-colors duration-300 group-hover:text-[#2a2d47]">Home</span>
                            <span
                                class="nav-highlight absolute bottom-0 left-0 w-full h-[2px] bg-[#f4efeb] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                            <span
                                class="absolute inset-0 bg-[#f4efeb] transform origin-top transition-transform duration-300 scale-y-0 group-hover:scale-y-100 -z-0"></span>
                        </a>

                        <!-- About Dropdown -->
                        <div class="relative inline-block text-left" id="about-dropdown">
                            <button type="button"
                                class="nav-link text-white text-base leading-[150%] font-medium relative group px-2 py-1 overflow-hidden flex items-center gap-x-1 {{ request()->is('team') ? 'active' : '' }}"
                                id="about-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span
                                    class="relative z-10 transition-colors duration-300 group-hover:text-[#2a2d47]">About</span>
                                <svg class="w-4 h-4 text-white group-hover:text-[#2a2d47] transition-colors duration-300"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span
                                    class="nav-highlight absolute bottom-0 left-0 w-full h-[2px] bg-[#f4efeb] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                                <span
                                    class="absolute inset-0 bg-[#f4efeb] transform origin-top transition-transform duration-300 scale-y-0 group-hover:scale-y-100 -z-0"></span>
                            </button>
                            <div class="hidden absolute z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="about-menu-button"
                                tabindex="-1" id="about-dropdown-menu">
                                <div class="py-1" role="none">
                                    <a href="{{ route('team') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                        tabindex="-1">Our Team</a>

                                </div>
                            </div>
                        </div>

                        <!-- Events Link -->
                        <a href="{{ route('events.index') }}"
                            class="nav-link text-white text-base leading-[150%] font-medium relative group px-2 py-1 overflow-hidden {{ request()->is('events*') ? 'active' : '' }}">
                            <span
                                class="relative z-10 transition-colors duration-300 group-hover:text-[#2a2d47]">Events</span>
                            <span
                                class="nav-highlight absolute bottom-0 left-0 w-full h-[2px] bg-[#f4efeb] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                            <span
                                class="absolute inset-0 bg-[#f4efeb] transform origin-top transition-transform duration-300 scale-y-0 group-hover:scale-y-100 -z-0"></span>
                        </a>

                        <!-- Articles Link -->
                        <a href="{{ route('articles.index') }}"
                            class="nav-link text-white text-base leading-[150%] font-medium relative group px-2 py-1 overflow-hidden {{ request()->is('articles*') ? 'active' : '' }}">
                            <span
                                class="relative z-10 transition-colors duration-300 group-hover:text-[#2a2d47]">Articles</span>
                            <span
                                class="nav-highlight absolute bottom-0 left-0 w-full h-[2px] bg-[#f4efeb] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                            <span
                                class="absolute inset-0 bg-[#f4efeb] transform origin-top transition-transform duration-300 scale-y-0 group-hover:scale-y-100 -z-0"></span>
                        </a>

                        <!-- Aspirasi Link -->
                        @auth
                            @if (auth()->user()->hasAnyRole(['admin', 'superadmin', 'hmif', 'user']))
                                <a href="{{ route('aspirasi') }}"
                                    class="nav-link text-white text-base leading-[150%] font-medium relative group px-2 py-1 overflow-hidden {{ request()->is('aspirasi*') ? 'active' : '' }}">
                                    <span
                                        class="relative z-10 transition-colors duration-300 group-hover:text-[#2a2d47]">Aspirasi</span>
                                    <span
                                        class="nav-highlight absolute bottom-0 left-0 w-full h-[2px] bg-[#f4efeb] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                                    <span
                                        class="absolute inset-0 bg-[#f4efeb] transform origin-top transition-transform duration-300 scale-y-0 group-hover:scale-y-100 -z-0"></span>
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
                <button id="mobile-menu-button"
                    class="md:hidden focus:outline-none group bg-[#2a4d69] p-2 rounded-md transition-all duration-300 hover:bg-[#203d54]"
                    aria-label="Toggle mobile menu" aria-expanded="false">
                    <div class="w-6 h-5 flex flex-col justify-between relative">
                        <span
                            class="w-6 h-0.5 bg-white rounded transform transition-transform duration-300 origin-right"
                            id="burger-top"></span>
                        <span class="w-6 h-0.5 bg-white rounded transition-opacity duration-300"
                            id="burger-middle"></span>
                        <span
                            class="w-6 h-0.5 bg-white rounded transform transition-transform duration-300 origin-right"
                            id="burger-bottom"></span>
                    </div>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu"
                class="hidden flex-col gap-4 items-center w-full mt-4 md:hidden transition-all duration-300 ease-in-out overflow-hidden shadow-lg rounded-xl border border-[#2a4d69]/20">
                <div class="w-full bg-gradient-to-b from-[#3a6186] to-[#2a4d69] backdrop-blur-md p-6 pt-4">
                    <!-- Home -->
                    <div class="w-full relative mt-2">
                        <a href="{{ route('home') }}"
                            class="w-full text-left py-3 px-4 text-white text-base leading-[150%] font-normal relative overflow-hidden group flex items-center gap-2 rounded-lg border-solid border-[1.5px] border-transparent transition-all duration-300 {{ request()->is('/') ? 'bg-[#136ca9]/40' : '' }}">
                            <span class="relative z-10 group-hover:text-white">Home</span>
                            <span
                                class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100 -z-0"></span>
                        </a>
                    </div>

                    <!-- About Dropdown -->
                    <div class="w-full relative mt-2" id="mobile-about-dropdown">
                        <button
                            class="w-full py-3 px-4 text-white text-base leading-[150%] font-normal relative overflow-hidden group flex items-center justify-between gap-1 rounded-lg hover:bg-white/10 transition-all duration-300 {{ request()->is('team') ? 'bg-[#136ca9]/40' : '' }}"
                            id="mobile-about-button">
                            <span class="relative z-10">About</span>
                            <svg class="w-4 h-4 text-white transition-transform duration-300" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true" id="about-dropdown-icon">
                                <path fill-rule="evenodd"
                                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span
                                class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100 -z-0"></span>
                        </button>
                        <div class="hidden bg-[#1e3c55] w-full rounded-lg overflow-hidden shadow-inner mt-1"
                            id="mobile-about-dropdown-menu">
                            <a href="{{ route('team') }}"
                                class="block w-full py-3 px-4 text-white text-sm leading-[150%] font-normal relative overflow-hidden group hover:bg-white/10 transition-colors duration-300 {{ request()->is('team') ? 'bg-[#136ca9]/40' : '' }}">
                                <span class="relative z-10">Our Team</span>
                                <span
                                    class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100 -z-0"></span>
                            </a>
                            <!-- Add more about sublinks as needed -->
                        </div>
                    </div>

                    <!-- Events -->
                    <div class="w-full relative mt-2">
                        <a href="{{ route('events.index') }}"
                            class="w-full text-left py-3 px-4 text-white text-base leading-[150%] font-normal relative overflow-hidden group flex items-center gap-2 rounded-lg border-solid border-[1.5px] border-transparent transition-all duration-300 {{ request()->is('events*') ? 'bg-[#136ca9]/40' : '' }}">
                            <span class="relative z-10 group-hover:text-white">Events</span>
                            <span
                                class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100 -z-0"></span>
                        </a>
                    </div>

                    <!-- Articles -->
                    <div class="w-full relative mt-2">
                        <a href="{{ route('articles.index') }}"
                            class="w-full text-left py-3 px-4 text-white text-base leading-[150%] font-normal relative overflow-hidden group flex items-center gap-2 rounded-lg border-solid border-[1.5px] border-transparent transition-all duration-300 {{ request()->is('articles*') ? 'bg-[#136ca9]/40' : '' }}">
                            <span class="relative z-10 group-hover:text-white">Articles</span>
                            <span
                                class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100 -z-0"></span>
                        </a>
                    </div>

                    @auth
                        @if (auth()->user()->hasAnyRole(['admin', 'superadmin', 'hmif', 'user']))
                            <!-- Aspirasi -->
                            <div class="w-full relative mt-2">
                                <a href="{{ route('aspirasi') }}"
                                    class="w-full text-left py-3 px-4 text-white text-base leading-[150%] font-normal relative overflow-hidden group flex items-center gap-2 rounded-lg border-solid border-[1.5px] border-transparent transition-all duration-300 {{ request()->is('aspirasi*') ? 'bg-[#136ca9]/40' : '' }}">
                                    <span class="relative z-10 group-hover:text-white">Aspirasi</span>
                                    <span
                                        class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100 -z-0"></span>
                                </a>
                            </div>
                        @endif
                    @endauth



                    <!-- Login Button -->
                    <div class="flex flex-row gap-4 items-center justify-center w-full mt-6 mb-2">
                        @auth
                            @if (auth()->user()->hasAnyRole(['admin', 'superadmin']))
                                <a href="{{ route('admin.dashboard') }}"
                                    class="relative overflow-hidden group border-[#2a2d47] flex flex-row gap-2 items-center justify-center px-5 py-2.5 rounded-full border-solid border-[1.5px] bg-[#f4efeb] text-[#2a2d47] text-base font-medium transition-colors duration-300 shadow-md w-full">
                                    <span class="relative z-10 group-hover:text-white">Admin Dashboard</span>
                                    <span
                                        class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100 -z-0"></span>
                                </a>
                            @elseif(auth()->user()->hasAnyRole(['hmif']))
                                <a href="{{ route('dashboard') }}"
                                    class="relative overflow-hidden group border-[#2a2d47] flex flex-row gap-2 items-center justify-center px-5 py-2.5 rounded-full border-solid border-[1.5px] bg-[#f4efeb] text-[#2a2d47] text-base font-medium transition-colors duration-300 shadow-md w-full">
                                    <span class="relative z-10 group-hover:text-white">Dashboard</span>
                                    <span
                                        class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100 -z-0"></span>
                                </a>
                            @else
                                <a href=""
                                    class="relative overflow-hidden group border-[#2a2d47] flex flex-row gap-2 items-center justify-center px-5 py-2.5 rounded-full border-solid border-[1.5px] bg-[#f4efeb] text-[#2a2d47] text-base font-medium transition-colors duration-300 shadow-md w-full">
                                    <span class="relative z-10 group-hover:text-white">HELLO</span>
                                    <span
                                        class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100 -z-0"></span>
                                </a>
                            @endif
                        @else
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"
                                class="relative overflow-hidden group border-[#2a2d47] flex flex-row gap-2 items-center justify-center px-5 py-2.5 rounded-full border-solid border-[1.5px] bg-[#f4efeb] text-[#2a2d47] text-base font-medium transition-colors duration-300 shadow-md w-full">
                                <span class="relative z-10 group-hover:text-white">Login</span>
                                <span
                                    class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100 -z-0"></span>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Desktop Login Button -->
            <div class="hidden md:flex flex-row gap-4 items-center">
                @auth
                    @if (auth()->user()->hasAnyRole(['admin', 'superadmin']))
                        <a href="{{ route('admin.dashboard') }}"
                            class="relative overflow-hidden group flex items-center justify-center px-5 py-2 rounded-full border-solid border-[1.5px] border-[#2a2d47] bg-[#f4efeb] text-[#2a2d47] text-base font-medium transition-all duration-300 shadow-md">
                            <span class="relative z-10 group-hover:text-white transition-colors duration-300">Admin
                                Dashboard</span>
                            <span
                                class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                            <span
                                class="absolute -inset-x-2 -inset-y-2 opacity-0 group-hover:opacity-20 transition-opacity duration-300 bg-gradient-to-r from-transparent via-white to-transparent blur-sm"></span>
                        </a>
                    @elseif(in_array(auth()->user()->role, ['hmif']))
                        <a href="{{ route('dashboard') }}"
                            class="relative overflow-hidden group flex items-center justify-center px-5 py-2 rounded-full border-solid border-[1.5px] border-[#2a2d47] bg-[#f4efeb] text-[#2a2d47] text-base font-medium transition-all duration-300 shadow-md">
                            <span
                                class="relative z-10 group-hover:text-white transition-colors duration-300">Dashboard</span>
                            <span
                                class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                            <span
                                class="absolute -inset-x-2 -inset-y-2 opacity-0 group-hover:opacity-20 transition-opacity duration-300 bg-gradient-to-r from-transparent via-white to-transparent blur-sm"></span>
                        </a>
                    @else
                        <form action="{{ route('logout') }}" method="POST" class="inline-block"
                            onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
                            @csrf
                            <button type="submit"
                                class="relative overflow-hidden group flex items-center justify-center px-5 py-2 rounded-full border-solid border-[1.5px] border-[#2a2d47] bg-[#f4efeb] text-[#2a2d47] text-base font-medium transition-all duration-300 shadow-md cursor-pointer">
                                <span class="relative z-10 group-hover:text-white transition-colors duration-300">
                                    {{ auth()->user()->role == 'user' ? 'Logout' : 'Keluar' }}
                                </span>
                                <span
                                    class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                                <span
                                    class="absolute -inset-x-2 -inset-y-2 opacity-0 group-hover:opacity-20 transition-opacity duration-300 bg-gradient-to-r from-transparent via-white to-transparent blur-sm"></span>
                            </button>
                        </form>
                    @endif
                    {{-- Role USER tidak ada tombol dashboard --}}
                @else
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"
                        class="relative overflow-hidden group flex items-center justify-center px-5 py-2 rounded-full border-solid border-[1.5px] border-[#2a2d47] bg-[#f4efeb] text-[#2a2d47] text-base font-medium transition-all duration-300 shadow-md hover:border-[#136ca9]">
                        <span class="relative z-10 group-hover:text-white transition-colors duration-300">Login</span>
                        <span
                            class="absolute inset-0 bg-[#136ca9] transform origin-left transition-transform duration-300 scale-x-0 group-hover:scale-x-100"></span>
                        <span
                            class="absolute -inset-x-2 -inset-y-2 opacity-0 group-hover:opacity-20 transition-opacity duration-300 bg-gradient-to-r from-transparent via-white to-transparent blur-sm"></span>
                    </a>
                @endauth
            </div>
        </div>
    </nav>



    <main class="w-full overflow-x-hidden pt-[60px] md:pt-[72px]">
        <div class="w-full max-w-full overflow-x-hidden">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="w-full bg-[#2a2d47] text-white" aria-label="Footer">
        <!-- Box-border ensures padding is included in width calculation -->
        <div class="box-border max-w-full mx-auto px-4 md:px-8 lg:px-16 py-8 md:py-12 overflow-x-hidden">
            <div class="flex flex-col md:flex-row gap-8 md:gap-16 items-start justify-between mb-8 md:mb-12">
                <!-- HMIF Info Section - Reduced width on mobile -->
                <div class="flex flex-col gap-6 items-start w-full max-w-[95%] md:w-[35%]">
                    <div class="flex items-center gap-4">
                        <img class="w-14 md:w-16 h-auto object-contain" src="{{ asset('images/logo_HMIF.png') }}"
                            alt="HMIF Logo">
                        <div class="flex flex-col">
                            <span class="text-blue-400 text-2xl md:text-xl font-bold">HMIF</span>
                            <span class="text-white text-2xl md:text-sm font-bold uppercase">Untirta</span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 items-start">
                        <h3 class="text-[#f4efeb] text-xs md:text-sm font-semibold">ADDRESS</h3>
                        <p class="text-white text-xs md:text-sm leading-[150%] max-w-[95%]">
                            Jl. Jendral Soedirman KM. 3 Cilegon 42435 Provinsi Banten
                        </p>
                    </div>

                    <!-- Social Media with flex-wrap -->
                    <div class="flex flex-wrap gap-2">
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-[#136ca9] flex items-center justify-center hover:bg-blue-600 transition"
                            aria-label="Facebook">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-[#136ca9] flex items-center justify-center hover:bg-blue-600 transition"
                            aria-label="Twitter">
                            <i class="fab fa-twitter text-sm"></i>
                        </a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-[#136ca9] flex items-center justify-center hover:bg-blue-600 transition"
                            aria-label="Instagram">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-[#136ca9] flex items-center justify-center hover:bg-blue-600 transition"
                            aria-label="Email">
                            <i class="fas fa-envelope text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Navigation & Connect - Reduced width on mobile, smaller gap -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2 md:gap-6 w-[95%] md:w-[60%]">
                    <!-- Navigation Column -->
                    <div class="flex flex-col gap-2 md:gap-4 items-start justify-start overflow-hidden">
                        <h3 class="text-[#f4efeb] text-sm font-semibold">Navigation</h3>
                        <div class="flex flex-col space-y-2 w-full">
                            <a href=""
                                class="text-white text-xs md:text-sm leading-[150%] font-normal hover:text-[#f4efeb] transition-colors duration-200 truncate">Home</a>
                            <a href=""
                                class="text-white text-xs md:text-sm leading-[150%] font-normal hover:text-[#f4efeb] transition-colors duration-200 truncate">About
                                Us</a>
                            <a href="{{ route('team') }}"
                                class="text-white text-xs md:text-sm leading-[150%] font-normal hover:text-[#f4efeb] transition-colors duration-200 pl-2 truncate">Our
                                Team</a>

                        </div>
                    </div>

                    <!-- Connect Column -->
                    <div class="flex flex-col gap-2 md:gap-4 items-start justify-start overflow-hidden">
                        <h3 class="text-[#f4efeb] text-sm font-semibold">Connect</h3>
                        <div class="flex flex-col space-y-2 w-full">
                            <a href="#"
                                class="text-white text-xs md:text-sm leading-[150%] font-normal hover:text-[#f4efeb] transition-colors duration-200 truncate">Contact
                                Us</a>
                            <a href="#"
                                class="text-white text-xs md:text-sm leading-[150%] font-normal hover:text-[#f4efeb] transition-colors duration-200 truncate">Join
                                Us</a>
                            <a href="#"
                                class="text-white text-xs md:text-sm leading-[150%] font-normal hover:text-[#f4efeb] transition-colors duration-200 truncate">Member
                                Login</a>
                        </div>
                    </div>

                    <!-- Support Column -->
                    <div class="flex flex-col gap-2 md:gap-4 items-start justify-start overflow-hidden">
                        <h3 class="text-[#f4efeb] text-sm font-semibold">Support</h3>
                        <div class="flex flex-col space-y-2 w-full">
                            <a href="#"
                                class="text-white text-xs md:text-sm leading-[150%] font-normal hover:text-[#f4efeb] transition-colors duration-200 truncate">FAQs</a>
                            <a href="#"
                                class="text-white text-xs md:text-sm leading-[150%] font-normal hover:text-[#f4efeb] transition-colors duration-200 truncate">Support</a>
                            <a href="#"
                                class="text-white text-xs md:text-sm leading-[150%] font-normal hover:text-[#f4efeb] transition-colors duration-200 truncate">Feedback</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright section -->
            <div class="text-center text-white text-xs pt-4 border-t border-gray-700">
                <p>&copy; {{ date('Y') }} HMIF Untirta. All rights reserved.</p>
            </div>
        </div>
    </footer>

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

    <script></script>
    @stack('scripts')
</body>

</html>
