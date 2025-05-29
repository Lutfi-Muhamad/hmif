<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 
        'detail', 
        'category', 
        'image',
        'event_date',    
        'start_time',    
        'end_time',      
        'location',      
        'status'         
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'event_date',
    ];

    // ENUM kategori event
    public const CATEGORIES = [
        'LOMBA' => 'Lomba',
        'WEBINAR' => 'Webinar',
        'MEETUP' => 'Meetup'
    ];

    // Opsional: tampilkan kategori dengan huruf kapital depan
    public function getFormattedCategoryAttribute()
    {
        return ucfirst(strtolower($this->category));
    }
}
