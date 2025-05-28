<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\UserController;
// use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\AspirasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemRecruitController;

use App\Models\Article;


// Route::get('/', function () {
//     // Mengambil artikel terbaru
//     $articles = Article::latest()->get();

//     // Menampilkan view dengan artikel yang dikirim
//     return view('welcome', compact('articles'));
// })->name('home');
// Redirect /login ke / dengan flash session untuk menampilkan modal login
Route::get('/login', function () {
    return redirect()->route('home')->with('show_login_modal', true);
})->name('login.redirect');

// Route post untuk login tetap ada
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute untuk artikel
Route::get('/articles/{id}', [HomeController::class, 'showArticle'])->name('articles.detail');
Route::get('/articles', [HomeController::class, 'articleIndex'])->name('articles.index');
Route::get('/events/filter', [HomeController::class, 'filterEvents'])->name('events.filter');
Route::get('/events', [HomeController::class, 'events'])->name('events.index');
Route::get('/events/{event}', [HomeController::class, 'eventDetail'])->name('events.detail');

//Rute untuk Registrasi
Route::get('/registrasi', [MemRecruitController::class, 'index'])->name('registrasi');
Route::get('/registrasi/create', [MemRecruitController::class, 'create'])->name('registrasi.create');
Route::post('/registrasi', [MemRecruitController::class, 'store'])->name('registrasi.store');

// Aspirasi routes protected by auth and role middleware
Route::middleware(['auth', 'role:hmif|admin|superadmin|user'])->group(function () {
    Route::get('/aspirasi', [HomeController::class, 'aspirasi'])->name('aspirasi');
    Route::post('/aspirasi', [HomeController::class, 'storeAspirasi'])->name('aspirasi.store');
    Route::get('/aspirasi/{id}/detail', [HomeController::class, 'detailAspirasi'])->name('aspirasi.detail');
    Route::get('/reload-captcha', [HomeController::class, 'reloadCaptcha'])->name('reload.captcha');
});

// Rute admin
// Fitur Khusus SuperAdmin (akses semua)
Route::prefix('admin')->middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/change-password', [DashboardController::class, 'changePassword'])->name('admin.change-password');
    Route::resource('users', UserController::class)->names('admin.users');
    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('admin.aspirasi');
    Route::post('/aspirasi/update/{aspirasi}', [AspirasiController::class, 'updateAspirasi'])->name('admin.aspirasi.update');
    Route::delete('/aspirasi/{aspirasi}', [AspirasiController::class, 'destroy'])->name('admin.aspirasi.destroy');
    Route::get('/admin/registrasi', [MemRecruitController::class, 'dashboard'])->name('admin.registrasi.index');
    Route::get('/admin/registrasi/{id}', [MemRecruitController::class, 'show'])->name('admin.registrasi.show');
    Route::patch('/admin/registrasi/{application}/status', [MemRecruitController::class, 'updateStatus'])->name('admin.registrasi.update-status');
});

// Fitur Admin dan SuperAdmin (artikel & event saja)
Route::prefix('admin')->middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/change-password', [DashboardController::class, 'changePassword'])->name('admin.change-password');
    Route::resource('articles', ArtikelController::class)->names('admin.articles');
    Route::resource('events', EventController::class)->names('admin.events');
});

// Rute user dan hmif 
Route::prefix('user')->middleware(['auth', 'role:hmif'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->middleware('auth')->name('user.dashboard');
});

// Rute dashboard umum untuk redirect
Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->hasAnyRole(['admin', 'superadmin'])) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->hasAnyRole(['hmif'])) {
            return redirect()->route('user.dashboard');
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



// API route for countdown
Route::get('/api/registrasi/countdown', [MemRecruitController::class, 'getCountdown']);
