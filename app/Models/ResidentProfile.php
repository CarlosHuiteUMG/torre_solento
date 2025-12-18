<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'dpi',
        'apartment_number',
        'floor',
        'resident_type',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
