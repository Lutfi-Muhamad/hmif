<?php

namespace App\Http\Controllers;

use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();  // Ambil artikel terbaru
        return view('welcome', compact('articles'));  // Kirim data artikel ke view
    }
}
