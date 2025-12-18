<?php

namespace App\Models;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'max_capacity',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function hasConflict($start, $end)
    {
        return $this->reservations()
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_time', [$start, $end])
                    ->orWhereBetween('end_time', [$start, $end])
                    ->orWhere(function ($sub) use ($start, $end) {
                        $sub->where('start_time', '<=', $start)
                            ->where('end_time', '>=', $end);
                    });
            })
            ->exists();
    }
}
