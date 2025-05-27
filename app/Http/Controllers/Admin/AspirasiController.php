<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aspirasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        
        // Ambil semua aspirasi dengan pagination (ascending berdasarkan created_at)
        $aspirasi = Aspirasi::orderBy('created_at', 'asc')->paginate(10);

        return view('admin.aspirasi', compact('aspirasi'));
    }
    
    /**
     * Update the specified aspirasi in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aspirasi  $aspirasi
     * @return \Illuminate\Http\Response
     */
    public function updateAspirasi(Request $request, Aspirasi $aspirasi)
    {
        $request->validate([
            'status' => 'required|in:pending,resolved',
            'response' => 'required_if:status,resolved|nullable|string',
        ]);
        
        $aspirasi->status = $request->status;
        
        if ($request->filled('response')) {
            $aspirasi->response = $request->response;
            $aspirasi->admin_id = Auth::id();
        }
        
        $aspirasi->save();
        
        return redirect()->route('admin.aspirasi')->with('success', 'Status aspirasi berhasil diperbarui.');
    }
    
    /**
     * Remove the specified aspirasi from storage.
     *
     * @param  \App\Models\Aspirasi  $aspirasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aspirasi $aspirasi)
    {
        // If there's any attachment/file associated with this aspirasi, delete it first
        if ($aspirasi->file && Storage::exists($aspirasi->file)) {
            Storage::delete($aspirasi->file);
        }
        
        // Delete the aspirasi record
        $aspirasi->delete();
        
        return redirect()->route('admin.aspirasi')->with('success', 'Aspirasi berhasil dihapus.');
    }
}