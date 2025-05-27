<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard HMIF</title>
    <link rel="icon" href="{{ asset('images/LOGO_HMIF.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/user.js', 'resources/css/user.css'])
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
                        <a href="#" class="dropdown-item">
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
                        <a href="#" class="nav-link active">
                            <i class="fas fa-home nav-icon"></i>
                            <span class="nav-text">Dashboard</span>
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
                            Made with <i class="fas fa-heart"></i> by RND X INTERNAL
                        </div>
                    </div>
                </footer>
            </main>
        </div>
    </div>

</body>

</html>
