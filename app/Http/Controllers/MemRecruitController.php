<?php

namespace App\Http\Controllers;

use App\Models\MemberRecruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MemRecruitController extends Controller
{
    public function index()
    {
        $isOpen = MemberRecruitment::isRegistrationOpen();
        $countdown = MemberRecruitment::getCountdown();

        return view('registrasi.index', compact('isOpen', 'countdown'));
    }

    public function create()
    {
        if(!MemberRecruitment::isRegistrationOpen()) {
            return redirect()->route('registrasi')->with('error', 'Pendaftaran belum dibuka');
        }

        return view('registrasi.create');
    }

    public function store(Request $request)
    {
        if(!MemberRecruitment::isRegistrationOpen()) {
            return redirect()->route('registrasi')->with('error', 'Pendaftaran belum dibuka');
        }

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'npm' => 'required|string|max:255|unique:member_recruitments,npm',
                'email' => 'required|email|unique:member_recruitments,email',
                'phone' => 'required|string|max:255',
                'tahun_angkatan' => 'required|integer',
                'alasan_masuk' => 'required|string',
            ]);

            if($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $application = MemberRecruitment::create([
                'name' => $request->name,
                'npm' => $request->npm,
                'email' => $request->email,
                'phone' => $request->phone,
                'tahun_angkatan' => $request->tahun_angkatan,
                'alasan_masuk' => $request->alasan_masuk,
                'status' => 'pending',
            ]);

            return redirect()->route('registrasi')
                ->with('success', 'Pendaftaran berhasil! Silakan tunggu pengumuman selanjutnya.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.')
                ->withInput();
        }
    }
    
    //Superadmin Controller
    public function dashboard()
    {
        $applications = MemberRecruitment::orderBy('submitted_at', 'desc')->paginate(20);
        $stats = [
            'total_applications' => MemberRecruitment::count(),
            'pending_applications' => MemberRecruitment::where('status', 'pending')->count(),
            'approved_applications' => MemberRecruitment::where('status', 'approved')->count(),
            'rejected_applications' => MemberRecruitment::where('status', 'rejected')->count(),
        ];

        return view('admin.registrasi.index', compact('applications', 'stats'));
    }

    public function updateStatus(Request $request, MemberRecruitment $application)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $application->update([
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Status pendaftaran berhasil diubah');
    }

    //API endpoint for countdown
    public function getCountdown()
    {   
        return response()->json([
            'is_open' => MemberRecruitment::isRegistrationOpen(),
            'countdown' => MemberRecruitment::getCountdown(),
        ]);
    }
}
