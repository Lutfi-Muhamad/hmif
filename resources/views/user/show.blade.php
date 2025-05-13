@extends('layouts.app') {{-- Atau layout yang kamu gunakan --}}

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if ($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="Image" class="w-full h-64 object-cover">
        @endif

        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $article->title }}</h1>

            <div class="text-sm text-gray-500 mb-4">
                Dipublikasikan pada {{ $article->created_at->format('d M Y') }} {{ $article->created_at->format('H:i') }}
            </div>

            <div class="text-gray-700 leading-relaxed text-base">
                {!! nl2br(e($article->content)) !!}
            </div>
        </div>
    </div>
</div>
@endsection
