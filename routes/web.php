<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EventController;

use App\Models\Article;


// Route::get('/', function () {
//     // Mengambil artikel terbaru
//     $articles = Article::latest()->get();

//     // Menampilkan view dengan artikel yang dikirim
//     return view('welcome', compact('articles'));
// })->name('home');

Route::get('/', [EventController::class, 'showEvents'])->name('home');


// Redirect /login ke / dengan flash session untuk menampilkan modal login
Route::get('/login', function () {
    return redirect()->route('home')->with('show_login_modal', true);
})->name('login.redirect');

// Route post untuk login tetap ada
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Rute admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('admin.dashboard');
    Route::post('/change-password', [DashboardController::class, 'changePassword'])->middleware('auth')->name('admin.change-password');
    Route::resource('users', UserController::class)->middleware('auth')->names('admin.users');
});

// Rute user
Route::prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->middleware('auth')->name('user.dashboard');
    // Tambahkan rute lain untuk user di sini
});

// Rute dashboard umum untuk redirect
Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->hasRole('user')) {
            return redirect()->route('user.dashboard'); // Perbaikan di sini
        }
    }

    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/team', function () {
    return view('team');
})->name('team');


// artikel admin
use App\Http\Controllers\ArticlesController;

Route::get('/admin/dashboard', [ArticlesController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/articles', [ArticlesController::class, 'store'])->name('admin.articles.store');

// Route untuk edit artikel
Route::get('/admin/articles/{article}/edit', [ArticlesController::class, 'edit'])->name('admin.articles.edit'); // Tampilkan form edit artikel

// Route untuk update artikel
Route::put('/admin/articles/{article}', [ArticlesController::class, 'update'])->name('admin.articles.update'); // Update artikel

// Route untuk hapus artikel
Route::delete('/admin/articles/{article}', [ArticlesController::class, 'destroy'])->name('admin.articles.destroy'); // Hapus artikel

// routes/web.php artikel show
Route::get('/articles/{id}', [ArticlesController::class, 'show'])->name('articles.show');

// rute tambahkan event
// routes/web.php

Route::post('/admin/events', [EventController::class, 'store'])->name('admin.events.store');

// untuk filter kategori
Route::get('/events/filter', [EventController::class, 'filter'])->name('events.filter');
