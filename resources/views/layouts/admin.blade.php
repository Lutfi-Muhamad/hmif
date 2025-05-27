<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    <link rel="icon" href="{{ asset('images/LOGO_HMIF.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js', 'resources/css/admin.css'])
</head>

<body data-success-message="{{ session('success') }}" data-error-message="{{ session('error') }}">
    <div class="min-h-screen">
        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-content">
                <div class="topbar-logo">
                    <a href="/">
                        <img src="{{ asset('images/LOGO_HMIF.png') }}" alt="HMIF Logo">
                    </a>
                        <button id="menu-toggle" class="menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>

                <div class="profile-dropdown">
                    <button id="profile-dropdown-toggle" class="profile-button">
                        <img src="{{ asset('images/avatar.png') }}" alt="Profile" class="profile-img">
                        <span class="profile-name">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down" style="font-size: 0.75rem; margin-left: 0.25rem;"></i>
                    </button>

                    <div id="dropdown-menu" class="dropdown-menu">
                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profileModal">
                            <i class="fas fa-user"></i>
                            <span>Profil Saya</span>
                            <span class="badge">SOON</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="dropdown-item w-full text-left flex items-center">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </header>

        <div class="main-container">
            <!-- Sidebar -->
            <aside id="sidebar" class="sidebar">
                <h6 class="section-title">MENU</h6>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home nav-icon"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    @if(auth()->user()->hasRole('superadmin'))                   
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon"></i>
                            <span class="nav-text">Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.registrasi.index') }}"
                            class="nav-link {{ request()->is('admin/registrasi*') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon"></i>
                            <span class="nav-text">Pendaftaran</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.aspirasi') }}"
                            class="nav-link {{ request()->is('admin/aspirasi*') ? 'active' : '' }}">
                            <i class="fas fa-comment-dots nav-icon"></i>
                            <span class="nav-text">Aspirasi</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('admin.events.index') }}"
                            class="nav-link {{ request()->is('admin/events*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt nav-icon"></i>
                            <span class="nav-text">Events</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.articles.index') }}"
                            class="nav-link {{ request()->is('admin/articles*') ? 'active' : '' }}">
                            <i class="fas fa-newspaper nav-icon"></i>
                            <span class="nav-text">Articles</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="fas fa-calendar nav-icon"></i>
                            <span class="nav-text">Calendar</span>
                        </a>
                    </li>
                    <h6 class="section-title">SETTINGS</h6>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="fas fa-cog nav-icon"></i>
                            <span class="nav-text">Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="fas fa-chart-bar nav-icon"></i>
                            <span class="nav-text">Reports</span>
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Main Content -->
            <main id="main-content" class="main-content">
                @yield('content')
                <!-- Footer -->
                <footer>
                    <div class="footer-container">
                        <div class="footer-copyright">
                            © 2025 Himpunan Mahasiswa Informatika
                        </div>
                        <div class="footer-credit">
                            Made with <i class="fas fa-heart"></i> by <a href="">RND</a>
                        </div>
                    </div>
                </footer>
            </main>
        </div>
    </div>

    <!-- Modal Profil yang Ditingkatkan -->
    <div id="profileModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay dengan animasi -->
            <div id="profileModalOverlay" class="fixed inset-0 transition-opacity duration-300 ease-in-out">
                <div class="absolute inset-0 bg-gray-900 opacity-75 backdrop-blur-sm"></div>
            </div>

            <!-- Modal container dengan animasi -->
            <div
                class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-xl text-left overflow-hidden shadow-2xl transform transition-all duration-300 ease-in-out sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-200 dark:border-gray-700">
                <div id="success-notification" class="hidden">
                    <div class="bg-green-50 dark:bg-green-900 border-l-4 border-green-500 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-500 dark:text-green-300"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700 dark:text-green-200" id="success-message">Password
                                    berhasil diubah</p>
                            </div>
                            <div class="ml-auto pl-3">
                                <div class="-mx-1.5 -my-1.5">
                                    <button type="button"
                                        class="close-notification inline-flex rounded-md p-1.5 text-green-500 dark:text-green-300 hover:bg-green-100 dark:hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <span class="sr-only">Dismiss</span>
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="error-notification" class="hidden">
                    <div class="bg-red-50 dark:bg-red-900/50 border-l-4 border-red-500 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500 dark:text-red-300"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700 dark:text-red-200" id="error-message">Password saat ini
                                    tidak cocok</p>
                            </div>
                            <div class="ml-auto pl-3">
                                <div class="-mx-1.5 -my-1.5">
                                    <button type="button"
                                        class="close-notification inline-flex rounded-md p-1.5 text-red-500 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <span class="sr-only">Dismiss</span>
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 px-6 pt-5 pb-4 sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white">Profil Saya</h3>
                            <div class="mt-6">
                                <!-- Tab navigation dengan animasi dan indikator aktif yang lebih jelas -->
                                <div class="border-b border-gray-200 dark:border-gray-700">
                                    <nav class="-mb-px flex space-x-8">
                                        <button id="tab-info"
                                            class="tab-button border-blue-500 text-blue-600 dark:text-blue-400 whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition-all duration-200">
                                            <i class="fas fa-info-circle mr-2"></i>Informasi Akun
                                        </button>
                                        <button id="tab-password"
                                            class="tab-button border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition-all duration-200">
                                            <i class="fas fa-key mr-2"></i>Ganti Password
                                        </button>
                                    </nav>
                                </div>

                                <!-- Tab content: Info -->
                                <div id="content-info" class="tab-content py-6">
                                    <div class="grid grid-cols-1 gap-6">
                                        <div class="space-y-6">
                                            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                                                <label
                                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nama</label>
                                                <input type="text" value="{{ auth()->user()->name }}"
                                                    class="bg-white dark:bg-gray-800 focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border border-gray-300 dark:border-gray-600 p-2.5 text-gray-700 dark:text-gray-200"
                                                    disabled>
                                            </div>

                                            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                                                <label
                                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                                <input type="email" value="{{ auth()->user()->email }}"
                                                    class="bg-white dark:bg-gray-800 focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border border-gray-300 dark:border-gray-600 p-2.5 text-gray-700 dark:text-gray-200"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab content: Password -->
                                <div id="content-password" class="tab-content py-6 hidden">
                                    <form id="passwordForm" action="{{ route('admin.change-password') }}"
                                        method="POST">
                                        @csrf
                                        <div class="space-y-6">
                                            <!-- Username field untuk meningkatkan aksesibilitas -->

                                            <!-- Field untuk Password Saat Ini -->
                                            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                                                <label for="current_password"
                                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Password
                                                    Saat Ini</label>
                                                <input type="password" name="current_password" id="current_password"
                                                    class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border border-gray-300 dark:border-gray-600 p-2.5 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200"
                                                    required autocomplete="current-password">
                                            </div>

                                            <!-- Field untuk Password Baru -->
                                            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                                                <label for="password"
                                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Password
                                                    Baru</label>
                                                <input type="password" name="password" id="password"
                                                    class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border border-gray-300 dark:border-gray-600 p-2.5 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200"
                                                    required autocomplete="new-password">
                                            </div>

                                            <!-- Field untuk Konfirmasi Password Baru -->
                                            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                                                <label for="password_confirmation"
                                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Konfirmasi
                                                    Password Baru</label>
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation"
                                                    class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border border-gray-300 dark:border-gray-600 p-2.5 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200"
                                                    required autocomplete="new-password">
                                            </div>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-900 px-6 py-4 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200 dark:border-gray-700">
                        <button type="submit" form="passwordForm" id="savePasswordBtn"
                            class="w-full inline-flex justify-center items-center px-5 py-2.5 border border-transparent rounded-lg shadow-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-200">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                        <button id="closeProfileModal" type="button"
                            class="mt-3 w-full inline-flex justify-center items-center rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm px-5 py-2.5 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm transition-all duration-200">
                            <i class="fas fa-times mr-2"></i> Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
