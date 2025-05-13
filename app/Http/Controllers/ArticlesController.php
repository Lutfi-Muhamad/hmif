<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;


class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        return view('admin.dashboard', compact('articles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('title', 'content');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $data['image'] = $imagePath;
        }

        Article::create($data);

        return redirect()->back()->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function showArticles()
    {
        $articles = Article::latest()->get();  // Ambil semua artikel terbaru
        return view('welcome', compact('articles'));  // Kirim data artikel ke view welcome
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('user.show', compact('article'));
    }


    // untuk edit artikel
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->content = $request->content;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($article->image) {
                Storage::delete('public/' . $article->image);
            }
            $imagePath = $request->file('image')->store('articles', 'public');
            $article->image = $imagePath;
        }

        $article->save();

        return redirect()->route('admin.dashboard')->with('success', 'Artikel berhasil diperbarui!');
    }

    // untuk hapus artikel
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Hapus gambar jika ada
        if ($article->image) {
            Storage::delete('public/' . $article->image);
        }

        $article->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Artikel berhasil dihapus!');
    }
}
