<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'category' => 'required|in:A,B,C',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'detail', 'category']);

        if ($request->hasFile('image')) {
            // Menyimpan gambar ke public/images
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Event::create($data);

        return redirect()->back()->with('success', 'Event berhasil ditambahkan!');
    }

    // tampilan di utama
    public function showEvents(Request $request)
    {
        $category = $request->query('category');

        if ($category && in_array($category, ['A', 'B', 'C'])) {
            $events = \App\Models\Event::where('category', $category)->latest()->get();
        } else {
            $events = \App\Models\Event::latest()->get();
        }

        $articles = \App\Models\Article::latest()->get(); // opsional kalau dipakai
        return view('welcome', compact('events', 'articles', 'category'));
    }

    // untuk filter
    public function filter(Request $request)
    {
        $category = $request->query('category');

        if ($category && in_array($category, ['A', 'B', 'C'])) {
            $events = \App\Models\Event::where('category', $category)->latest()->get();
        } else {
            $events = \App\Models\Event::latest()->get();
        }

        return response()->json([
            'html' => view('components.event-cards', compact('events'))->render()
        ]);
    }
}
