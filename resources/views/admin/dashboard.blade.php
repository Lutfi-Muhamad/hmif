@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <h1 class="text-xl font-semibold mb-4">Dashboard</h1>
        <p class="mb-4">Welcome to the improved HMIF Dashboard with a beautiful sidebar!</p>

        {{-- Tombol Tambah Artikel --}}
        <button onclick="document.getElementById('addArticleModal').showModal()"
            class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah Artikel</button>

        {{-- Modal Tambah Artikel --}}
        <dialog id="addArticleModal" class="rounded-lg p-6 w-full max-w-md shadow-xl">
            <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                @csrf
                <h2 class="text-lg font-semibold mb-4">Tambah Artikel</h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Judul</label>
                    <input name="title" required class="w-full border p-2 rounded" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Konten</label>
                    <textarea name="content" required class="w-full border p-2 rounded" rows="4"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Gambar (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded" />
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('addArticleModal').close()"
                        class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </dialog>

        {{-- Tombol Tambah Event --}}
        <button onclick="document.getElementById('addEventModal').showModal()"
            class="bg-green-500 text-white px-4 py-2 rounded mt-4">+ Tambah Event</button>

        {{-- Modal Tambah Event --}}
        <dialog id="addEventModal" class="rounded-lg p-6 w-full max-w-md shadow-xl">
            <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
                @csrf
                <h2 class="text-lg font-semibold mb-4">Tambah Event</h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Judul</label>
                    <input name="title" required class="w-full border p-2 rounded" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Detail</label>
                    <textarea name="detail" required class="w-full border p-2 rounded" rows="4"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Kategori</label>
                    <select name="category" class="w-full border p-2 rounded" required>
                        <option value="A">Kategori A</option>
                        <option value="B">Kategori B</option>
                        <option value="C">Kategori C</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Gambar (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded" />
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('addEventModal').close()"
                        class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </dialog>


        {{-- Tabel Artikel --}}
        <div class="mt-6">
            <h2 class="text-lg font-semibold mb-2">Daftar Artikel</h2>
            <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Judul</th>
                        <th class="border px-4 py-2 text-left">Konten</th>
                        <th class="border px-4 py-2 text-left">Gambar</th>
                        <th class="border px-4 py-2 text-left">Tanggal</th>
                        <th class="border px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td class="border px-4 py-2">{{ $article->title }}</td>
                            <td class="border px-4 py-2">{{ \Illuminate\Support\Str::limit($article->content, 100) }}</td>
                            <td class="border px-4 py-2">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="Image"
                                        class="w-24 rounded shadow" />
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">{{ $article->created_at->format('d M Y') }}</td>
                            <td class="border px-4 py-2 flex gap-2">
                                {{-- Tombol Edit --}}
                                <button onclick="openEditModal({{ json_encode($article) }})"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</button>


                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center px-4 py-2">Belum ada artikel.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tabel Event --}}
        <div class="mt-10">
            <h2 class="text-lg font-semibold mb-2">Daftar Event</h2>
            <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Judul</th>
                        <th class="border px-4 py-2 text-left">Detail</th>
                        <th class="border px-4 py-2 text-left">Kategori</th>
                        <th class="border px-4 py-2 text-left">Gambar</th>
                        <th class="border px-4 py-2 text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Event::latest()->get() as $event)
                        <tr>
                            <td class="border px-4 py-2">{{ $event->title }}</td>
                            <td class="border px-4 py-2">{{ Str::limit($event->detail, 100) }}</td>
                            <td class="border px-4 py-2">{{ $event->category }}</td>
                            <td class="border px-4 py-2">
                                @if ($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="Image"
                                        class="w-24 rounded shadow" />
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">{{ $event->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center px-4 py-2">Belum ada event.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>




    {{-- edit modal --}}
    {{-- Modal Edit Artikel --}}
    <dialog id="editArticleModal" class="rounded-lg p-6 w-full max-w-md shadow-xl">
        <form method="POST" action="" id="editArticleForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h2 class="text-lg font-semibold mb-4">Edit Artikel</h2>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Judul</label>
                <input name="title" id="editTitle" required class="w-full border p-2 rounded" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Konten</label>
                <textarea name="content" id="editContent" required class="w-full border p-2 rounded" rows="4"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Gambar (Opsional)</label>
                <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded" />
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('editArticleModal').close()"
                    class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </dialog>



    <script>
        function openEditModal(article) {
            // Isi form edit dengan data artikel
            document.getElementById('editTitle').value = article.title;
            document.getElementById('editContent').value = article.content;
            document.getElementById('editArticleForm').action = `/admin/articles/${article.id}`;

            // Tampilkan modal
            document.getElementById('editArticleModal').showModal();
        }
    </script>
@endsection
