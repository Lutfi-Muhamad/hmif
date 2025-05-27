@extends('layouts.app')

@section('title', 'Registrasi HMIF - Himpunan Mahasiswa Informatika')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-[#2a2d47] mb-4">Registrasi Anggota HMIF</h1>
            <div class="w-24 h-1 bg-[#136ca9] mx-auto mb-6"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Bergabunglah bersama kami di Himpunan Mahasiswa Informatika untuk mengembangkan potensi dan berkontribusi dalam dunia teknologi informasi.
            </p>
        </div>

        <!-- Registration Status Card -->
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="p-8">
                @if($isOpen)
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-4">
                            <i class="fas fa-check-circle text-3xl text-green-500"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Pendaftaran Sedang Dibuka!</h2>
                        <p class="text-gray-600 mb-6">Segera daftarkan diri Anda untuk bergabung dengan HMIF</p>
                        <a href="{{ route('registrasi.create') }}" 
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#136ca9] hover:bg-[#2a2d47] transition-colors duration-300">
                            Daftar Sekarang
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4">
                            <i class="fas fa-clock text-3xl text-[#136ca9]"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Pendaftaran Akan Dibuka</h2>
                        <p class="text-gray-600 mb-6">Pendaftaran akan dibuka dalam:</p>
                        
                        @if($countdown)
                            <div class="grid grid-cols-4 gap-4 max-w-md mx-auto">
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <span class="text-3xl font-bold text-[#136ca9]" id="countdown-days">{{ $countdown['days'] }}</span>
                                    <span class="block text-sm text-gray-600 mt-1">Hari</span>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <span class="text-3xl font-bold text-[#136ca9]" id="countdown-hours">{{ $countdown['hours'] }}</span>
                                    <span class="block text-sm text-gray-600 mt-1">Jam</span>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <span class="text-3xl font-bold text-[#136ca9]" id="countdown-minutes">{{ $countdown['minutes'] }}</span>
                                    <span class="block text-sm text-gray-600 mt-1">Menit</span>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <span class="text-3xl font-bold text-[#136ca9]" id="countdown-seconds">{{ $countdown['seconds'] }}</span>
                                    <span class="block text-sm text-gray-600 mt-1">Detik</span>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Information Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <!-- Requirements Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-list-check text-xl text-[#136ca9]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Persyaratan</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Mahasiswa aktif jurusan Informatika</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Memiliki NPM yang valid</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Email aktif (@untirta.ac.id)</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Benefits Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-star text-xl text-[#136ca9]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Keuntungan</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Pengembangan soft & hard skills</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Networking dengan alumni</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Kesempatan magang & kerja</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Process Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-tasks text-xl text-[#136ca9]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Proses Seleksi</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Pendaftaran online</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Verifikasi data</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Pengumuman hasil</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Countdown Timer
    function updateCountdown() {
        fetch('/api/registrasi/countdown')
            .then(response => response.json())
            .then(data => {
                if (data.countdown) {
                    document.getElementById('countdown-days').textContent = data.countdown.days;
                    document.getElementById('countdown-hours').textContent = data.countdown.hours;
                    document.getElementById('countdown-minutes').textContent = data.countdown.minutes;
                    document.getElementById('countdown-seconds').textContent = data.countdown.seconds;
                }
            });
    }

    // Update countdown every second if registration is not open
    @if(!$isOpen && $countdown)
        setInterval(updateCountdown, 1000);
    @endif
</script>
@endpush
@endsection 