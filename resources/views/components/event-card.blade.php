@props(['event'])

<div class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col h-full">
    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">

    <div class="p-4 flex flex-col justify-between flex-grow">
        {{-- Tanggal dan Lokasi --}}
        <div class="mb-2">
            <p class="text-sm text-gray-500">
                {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                • {{ $event->location }}
            </p>
        </div>

        {{-- Judul --}}
        <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">
            {{ $event->title }}
        </h3>

        {{-- Kategori dan Status --}}
        <div class="flex justify-between items-center text-sm text-gray-600 mb-3">
            <span class="px-2 py-1 bg-indigo-100 text-indigo-600 rounded-full text-xs font-medium">
                {{ $event->category }}
            </span>
            <span class="px-2 py-1 bg-green-100 text-green-600 rounded-full text-xs font-medium capitalize">
                {{ $event->status }}
            </span>
        </div>

        {{-- Tombol Detail --}}
        <a href="{{ route('events.detail', $event->id) }}"
            class="mt-auto text-center bg-blue-600 text-white py-2 px-4 rounded-xl hover:bg-blue-700 transition">
            Lihat Detail
        </a>
    </div>
</div>
