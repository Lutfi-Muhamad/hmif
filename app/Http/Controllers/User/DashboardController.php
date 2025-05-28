<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole(['hmif'])) {
            return redirect('/'); // Redirect ke halaman utama jika bukan admin
        }elseif(auth()->user()->hasRole('admin')){
            return redirect('/admin/dashboard'); // Redirect ke halaman admin jika admin
        }
        return view('user.dashboard');
    }
    
}