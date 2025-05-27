<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
class MemberRecruitment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'npm',
        'email',
        'phone',
        'tahun_angkatan',
        'alasan_masuk',
        'status',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public static function isRegistrationOpen()
    {
        return true;

        // $openDate = config('hmif_registration.open_date', '2025-07-01 00:00:00');
        // $closeDate = config('hmif_registration.close_date', '2025-07-31 23:59:59');

        // $now = Carbon::now();
        // $open = Carbon::parse($openDate);
        // $close = Carbon::parse($closeDate);

        // return $now->between($open, $close);
    }

    public static function getCountdown()
    {
        $openDate = config('hmif_registration.open_date', '2025-07-01 00:00:00');
        
        $now = Carbon::now();
        $target = Carbon::parse($openDate);

        if($now->greaterThan($target)) {
            return null;
        }
        $diff = $now->diffInSeconds($target);
        
        return [
            'days' => floor($diff / 86400),
            'hours' => floor(($diff % 86400) / 3600),
            'minutes' => floor(($diff % 3600) / 60),
            'seconds' => $diff % 60,
            'total_seconds' => $diff,
        ];
    }
        
    

}
