<?php

namespace App\Http\Controllers\Admin;

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
        
        if (!auth()->user()->hasRole(['admin', 'superadmin'])) {
            return redirect('/'); // Redirect ke halaman utama jika bukan admin
        }
        return view('admin.dashboard');
    }
    

    public function changePassword(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.required' => 'Password saat ini harus diisi',
            'password.required' => 'Password baru harus diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password baru minimal 8 karakter',
        ]);

        // Cek password saat ini
        $user = Auth::user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password saat ini tidak cocok'
                ], 422);
            }
            return back()->with('error', 'Password saat ini tidak cocok');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Password berhasil diubah'
            ]);
        }
        
        return back()->with('success', 'Password berhasil diubah');
    }
}