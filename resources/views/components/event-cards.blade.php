@forelse ($events as $event)
    <div
        class="bg-white rounded-2xl shadow-md overflow-hidden transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg">
        @if ($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                No Image
            </div>
        @endif
        <div class="p-6">
            <div class="flex flex-wrap items-center gap-2 mb-3">
                <h4 class="text-xl md:text-2xl font-semibold text-gray-800">{{ $event->title }}</h4>
                <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">
                    {{ $event->category }}
                </span>
            </div>
            <div class="flex flex-wrap gap-3 text-sm text-gray-500 mb-4">
                <span>{{ $event->created_at->format('M d, Y') }}</span>
            </div>
            <p class="text-gray-600 text-sm md:text-base">
                {{ $event->detail }}
            </p>
        </div>
    </div>
@empty
    <p class="text-center text-gray-500 col-span-2">Tidak ada event pada kategori ini.</p>
@endforelse
