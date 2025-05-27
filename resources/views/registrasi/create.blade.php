@extends('layouts.app')

@section('title', 'Form Pendaftaran HMIF - Himpunan Mahasiswa Informatika')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#2a2d47] mb-2">Form Pendaftaran HMIF</h1>
            <div class="w-20 h-1 bg-[#136ca9] mx-auto mb-4"></div>
            <p class="text-gray-600">Silakan lengkapi form di bawah ini dengan data yang valid</p>
        </div>

        <!-- Registration Form -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <form action="{{ route('registrasi.store') }}" method="POST" class="p-8">
                @csrf

                @if(session('error'))
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Name Field -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#136ca9] focus:border-transparent @error('name') border-red-500 @enderror"
                           value="{{ old('name') }}" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NPM Field -->
                <div class="mb-6">
                    <label for="npm" class="block text-sm font-medium text-gray-700 mb-2">NPM</label>
                    <input type="text" name="npm" id="npm" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#136ca9] focus:border-transparent @error('npm') border-red-500 @enderror"
                           value="{{ old('npm') }}" required>
                    @error('npm')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email (@untirta.ac.id)</label>
                    <input type="email" name="email" id="email" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#136ca9] focus:border-transparent @error('email') border-red-500 @enderror"
                           value="{{ old('email') }}" required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div class="mb-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="tel" name="phone" id="phone" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#136ca9] focus:border-transparent @error('phone') border-red-500 @enderror"
                           value="{{ old('phone') }}" required>
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tahun Angkatan Field -->
                <div class="mb-6">
                    <label for="tahun_angkatan" class="block text-sm font-medium text-gray-700 mb-2">Tahun Angkatan</label>
                    <select name="tahun_angkatan" id="tahun_angkatan" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#136ca9] focus:border-transparent @error('tahun_angkatan') border-red-500 @enderror"
                            required>
                        <option value="">Pilih Tahun Angkatan</option>
                        @for($i = date('Y'); $i >= date('Y')-4; $i--)
                            <option value="{{ $i }}" {{ old('tahun_angkatan') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    @error('tahun_angkatan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alasan Masuk Field -->
                <div class="mb-8">
                    <label for="alasan_masuk" class="block text-sm font-medium text-gray-700 mb-2">Alasan Bergabung dengan HMIF</label>
                    <textarea name="alasan_masuk" id="alasan_masuk" rows="4" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#136ca9] focus:border-transparent @error('alasan_masuk') border-red-500 @enderror"
                              required>{{ old('alasan_masuk') }}</textarea>
                    @error('alasan_masuk')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('registrasi') }}" 
                       class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#136ca9]">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#136ca9] hover:bg-[#2a2d47] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#136ca9] transition-colors duration-300">
                        Kirim Pendaftaran
                        <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 