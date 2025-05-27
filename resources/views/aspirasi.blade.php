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

        /* Improved Alert styling */
        .custom-alert {
            position: relative;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
            animation: fade-in-up 0.4s ease-out;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .custom-alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .custom-alert-danger {
            background-color: #fef2f2;
            color: #b91c1c;
            border-left: 4px solid #ef4444;
        }

        .custom-alert .alert-content {
            flex: 1;
            display: flex;
            align-items: center;
        }

        .custom-alert .alert-icon {
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .custom-alert .btn-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            padding: 0.5rem;
            cursor: pointer;
            color: inherit;
            opacity: 0.6;
            transition: opacity 0.2s ease;
        }

        .custom-alert .btn-close:hover {
            opacity: 1;
        }

        /* Form focus effects */
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        /* Custom checkbox styling */
        .custom-checkbox {
            position: relative;
            padding-left: 35px;
            cursor: pointer;
            user-select: none;
        }

        .custom-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .custom-checkbox:hover input~.checkmark {
            background-color: #e5e7eb;
        }

        .custom-checkbox input:checked~.checkmark {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .custom-checkbox input:checked~.checkmark:after {
            display: block;
        }

        .custom-checkbox .checkmark:after {
            left: 7px;
            top: 3px;
            width: 6px;
            height: 11px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /* Card styling */
        .aspirasi-card {
            transition: all 0.3s ease;
        }

        .aspirasi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Captcha styling */
        .captcha-img {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .captcha-img:hover {
            opacity: 0.9;
        }

        /* Captcha refresh spinner */
        .refresh-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(59, 130, 246, 0.3);
            border-radius: 50%;
            border-top-color: #3b82f6;
            animation: spin 1s ease-in-out infinite;
            position: absolute;
            top: calc(50% - 10px);
            left: calc(50% - 10px);
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: rgba(203, 213, 225, 0.8) transparent;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(203, 213, 225, 0.8);
            border-radius: 20px;
            border: 2px solid transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(148, 163, 184, 0.8);
        }
    </style>
@endsection

@section('content')
    <!-- Aspirasi Header Section with Background -->
    <div class="w-full relative mb-8" aria-labelledby="aspirasi-heading">
        <div class="w-full relative overflow-hidden h-[250px] md:h-[300px]">
            <div class="w-full h-full bg-gradient-to-r from-blue-600 to-blue-900"></div>
        </div>

        <!-- Overlay with content -->
        <div class="absolute inset-0 flex items-center bg-gradient-to-b from-black/60 to-black/60">
            <!-- Decorative frame corners -->
            <div class="absolute top-4 left-4 w-12 h-12 border-t-2 border-l-2 border-blue-300 opacity-80"></div>
            <div class="absolute top-4 right-4 w-12 h-12 border-t-2 border-r-2 border-blue-300 opacity-80"></div>
            <div class="absolute bottom-4 left-4 w-12 h-12 border-b-2 border-l-2 border-blue-300 opacity-80"></div>
            <div class="absolute bottom-4 right-4 w-12 h-12 border-b-2 border-r-2 border-blue-300 opacity-80"></div>

            <!-- Content container -->
            <div class="max-w-5xl mx-auto px-4 md:px-8 lg:px-16 w-full z-10">
                <div class="flex flex-col gap-4 items-center justify-center w-full text-center">
                    <!-- Aspirasi Title -->
                    <div class="overflow-hidden">
                        <h1 id="aspirasi-heading"
                            class="text-white text-3xl md:text-4xl lg:text-5xl font-bold animate-fade-in-up"
                            style="text-shadow: 0px 2px 4px rgba(0,0,0,0.5); letter-spacing: -0.01em;">
                            Aspirasi Mahasiswa
                        </h1>
                    </div>

                    <!-- Subtitle -->
                    <p class="text-white/90 text-lg md:text-xl max-w-2xl mx-auto animate-fade-in">
                        Sampaikan saran, kritik, dan aspirasimu untuk kemajuan jurusan Informatika
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full bg-gray-100 py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <!-- Improved Alert Notifications -->
            @if (session('success'))
                <div id="alert-success"
                    class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm"
                    role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-green-500 mr-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p>{{ session('success') }}</p>
                        </div>
                        <button type="button" class="ml-auto text-green-700"
                            onclick="document.getElementById('alert-success').remove()">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div id="alert-error" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm"
                    role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-red-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <p>{{ session('error') }}</p>
                        </div>
                        <button type="button" class="ml-auto text-red-700"
                            onclick="document.getElementById('alert-error').remove()">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden p-6 md:p-8 border border-gray-100">
                        <h2
                            class="text-2xl font-bold text-gray-800 mb-8 relative after:absolute after:content-[''] after:w-20 after:h-1 after:bg-blue-600 after:-bottom-3 after:left-0">
                            Form Aspirasi
                        </h2>

                        <!-- Alpine.js component directly in the template, for simplicity -->
                        <form id="aspirasi-form" action="{{ route('aspirasi.store') }}" method="POST" class="space-y-8"
                            x-data="{
                                isLoading: false,
                                refreshCaptcha() {
                                    this.isLoading = true;
                            
                                    fetch('{{ route('reload.captcha') }}')
                                        .then(response => response.json())
                                        .then(data => {
                                            const captchaImg = document.getElementById('captcha-image');
                                            captchaImg.src = data.captcha;
                                            setTimeout(() => { this.isLoading = false; }, 500);
                                        })
                                        .catch(error => {
                                            console.error('Error refreshing captcha:', error);
                                            this.isLoading = false;
                                        });
                                },
                                toggleAnonymous() {
                                    const nameInput = document.getElementById('name');
                                    const isAnonymous = document.getElementById('is_anonymous').checked;
                            
                                    if (nameInput) {
                                        nameInput.disabled = isAnonymous;
                                        if (isAnonymous) {
                                            nameInput.value = '';
                                        }
                                    }
                                }
                            }">
                            @csrf

                            <!-- Name Field -->
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                <div class="relative group">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none z-20">
                                        <svg class="w-5 h-5 text-blue-500 group-focus-within:text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="text" name="name" id="name"
                                        class="pl-11 block w-full rounded-xl border border-gray-200 bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 shadow-sm transition-all duration-200 py-3.5 text-gray-700"
                                        placeholder="Masukkan nama anda" value="{{ old('name') }}"
                                        {{ old('is_anonymous') ? 'disabled' : '' }}>
                                    <div
                                        class="absolute top-0 left-0 right-0 h-full border border-transparent group-focus-within:border-blue-500 rounded-xl pointer-events-none">
                                    </div>
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1.5 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Anonymous Checkbox -->
                            <div class="pt-1">
                                <label
                                    class="custom-checkbox flex items-center bg-gray-50 p-3 rounded-xl border border-gray-200 hover:bg-gray-100 transition-colors cursor-pointer">
                                    <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1"
                                        {{ old('is_anonymous') ? 'checked' : '' }} @change="toggleAnonymous()">
                                    <span class="checkmark"></span>
                                    <span class="ml-2 text-gray-700">Kirim sebagai anonim</span>
                                </label>
                            </div>

                            <!-- Aspirasi Field -->
                            <div class="space-y-2" x-data="{
                                charCount: 0,
                                formatText(format) {
                                    const textarea = document.getElementById('aspirasi-area');
                                    if (!textarea) return;
                            
                                    const selectionStart = textarea.selectionStart;
                                    const selectionEnd = textarea.selectionEnd;
                                    const selectedText = textarea.value.substring(selectionStart, selectionEnd);
                            
                                    let formattedText = '';
                                    let cursorPosition = 0;
                            
                                    switch (format) {
                                        case 'bold':
                                            formattedText = `**${selectedText}**`;
                                            cursorPosition = selectionStart + 2;
                                            break;
                                        case 'italic':
                                            formattedText = `*${selectedText}*`;
                                            cursorPosition = selectionStart + 1;
                                            break;
                                        case 'code':
                                            formattedText = `\`${selectedText}\``;
                                            cursorPosition = selectionStart + 1;
                                            break;
                                    }
                            
                                    // Replace the selected text with the formatted text
                                    const textBefore = textarea.value.substring(0, selectionStart);
                                    const textAfter = textarea.value.substring(selectionEnd);
                            
                                    textarea.value = textBefore + formattedText + textAfter;
                                    this.charCount = textarea.value.length;
                            
                                    // Set the cursor position
                                    if (selectedText.length > 0) {
                                        // If text was selected, place cursor after the formatted text
                                        textarea.selectionStart = selectionStart + formattedText.length;
                                        textarea.selectionEnd = selectionStart + formattedText.length;
                                    } else {
                                        // If no text was selected, place cursor inside the formatting tags
                                        textarea.selectionStart = cursorPosition;
                                        textarea.selectionEnd = cursorPosition;
                                    }
                            
                                    // Focus back on the textarea
                                    textarea.focus();
                            
                                    // Trigger auto-resize
                                    this.adjustTextareaHeight(textarea);
                                },
                                adjustTextareaHeight(textarea) {
                                    // Reset height to avoid compound growth
                                    textarea.style.height = 'auto';
                            
                                    // Set to scrollHeight but limit to max-height
                                    const newHeight = Math.min(textarea.scrollHeight, 300);
                                    textarea.style.height = newHeight + 'px';
                                },
                                init() {
                                    const textarea = document.getElementById('aspirasi-area');
                                    if (textarea) {
                                        this.charCount = textarea.value.length;
                            
                                        // Initial resize if there's content
                                        if (textarea.value) {
                                            this.adjustTextareaHeight(textarea);
                                        }
                            
                                        // Set up input event handler
                                        textarea.addEventListener('input', () => {
                                            this.charCount = textarea.value.length;
                                            this.adjustTextareaHeight(textarea);
                                        });
                                    }
                                }
                            }">
                                <label for="aspirasi"
                                    class="block text-sm font-medium text-gray-700 mb-1">Aspirasi</label>
                                <div class="relative group">
                                    <div class="absolute top-3.5 left-3.5 pointer-events-none z-20">
                                        <svg class="w-5 h-5 text-blue-500 group-focus-within:text-blue-600"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div
                                        class="overflow-hidden rounded-xl border border-gray-200 shadow-sm focus-within:border-blue-500 focus-within:ring-4 focus-within:ring-blue-500/20 transition-all duration-200">
                                        <textarea name="aspirasi" id="aspirasi-area" rows="5"
                                            class="pl-11 pt-3 block w-full border-0 focus:ring-0 bg-white resize-none text-gray-700 overflow-auto custom-scrollbar"
                                            placeholder="Tuliskan aspirasi, saran, atau kritik anda" style="min-height: 160px; max-height: 300px;">{{ old('aspirasi') }}</textarea>
                                        <div
                                            class="flex items-center justify-between px-3 py-2 border-t border-gray-100 bg-gray-50">
                                            <div class="flex flex-wrap items-center text-xs text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    class="w-3.5 h-3.5 flex-shrink-0 mt-0.5 text-blue-500">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>Tip: Sampaikan Aspirasi Anda Secara <span class="font-semibold">
                                                        Singkat, Jelas, dan
                                                        Padat</span></span>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                <span x-text="charCount">0</span> karakter
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @error('aspirasi')
                                    <p class="text-red-500 text-sm mt-1.5 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Captcha Field -->
                            <div class="space-y-4 pt-1">
                                <label class="block text-sm font-medium text-gray-700">Verifikasi Captcha</label>

                                <div class="flex flex-col md:flex-row gap-4">
                                    <div id="captcha-container"
                                        class="bg-gradient-to-r from-blue-50 via-indigo-50 to-blue-50 p-4 rounded-xl flex items-center justify-center min-h-[70px] relative border border-blue-100 shadow-sm">
                                        <img src="{{ captcha_src('math') }}" alt="Captcha" class="h-20 captcha-img"
                                            id="captcha-image" @click="refreshCaptcha()"
                                            :class="{ 'opacity-30': isLoading }" title="Klik untuk menyegarkan captcha">
                                        <div class="refresh-spinner" x-show="isLoading"></div>
                                    </div>

                                    <div class="flex-grow">
                                        <div class="relative group">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none z-20">
                                                <svg class="w-5 h-5 text-blue-500 group-focus-within:text-blue-600"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <input type="text" name="captcha"
                                                class="pl-11 block w-full rounded-xl border border-gray-200 bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 shadow-sm transition-all duration-200 py-3.5 text-gray-700"
                                                placeholder="Masukkan hasil perhitungan matematika">
                                            <div
                                                class="absolute top-0 left-0 right-0 h-full border border-transparent group-focus-within:border-blue-500 rounded-xl pointer-events-none">
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2.5 italic ml-1">Masukkan hasil perhitungan
                                            matematika yang ditampilkan pada gambar</p>
                                        @error('captcha')
                                            <p class="text-red-500 text-sm mt-1.5 flex items-center">
                                                <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="flex items-center">
                                        <button type="button"
                                            class="captcha-refresh h-14 w-14 flex items-center justify-center text-blue-600 hover:text-white bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-500 hover:to-blue-600 rounded-xl transition-all duration-300 shadow-sm hover:shadow-md border border-blue-200 hover:border-blue-500"
                                            title="Refresh captcha" @click="refreshCaptcha()">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end mt-10">
                                <button type="submit"
                                    class="inline-flex items-center px-8 py-3.5 border border-transparent text-base font-semibold rounded-xl shadow-md text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-300 transform hover:-translate-y-1">
                                    Kirim Aspirasi
                                    <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Aspirasi Modal -->
    <div id="aspirasiModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/60 backdrop-blur-md">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative">
                <!-- Close Button -->
                <button id="closeAspirasiModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <!-- Modal Content -->
                <h3 class="text-lg font-semibold text-gray-900" id="aspirasiName"></h3>
                <p class="text-sm text-gray-500 mt-1" id="aspirasiDate"></p>
                <p class="text-gray-600 mt-4" id="aspirasiContent"></p>
                <div class="mt-4">
                    <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full" id="aspirasiStatus"></span>
                </div>
            </div>
        </div>
    </div>
@endsection
