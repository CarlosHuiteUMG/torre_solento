<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'area_id',
        'start_time',
        'end_time',
        'status',
        'attendees',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_time', '>=', now());
    }

    public function scopeForUserOrAdmin($query, $user)
    {
        if ($user && $user->hasRole('admin')) {
            return $query;
        }

        return $query->where('user_id', optional($user)->id);
    }
}
