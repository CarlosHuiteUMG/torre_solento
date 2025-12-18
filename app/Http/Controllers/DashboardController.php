<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $areas = Area::orderBy('name')->get();
        $reservations = Reservation::with('area', 'user')
            ->upcoming()
            ->forUserOrAdmin($user)
            ->get();

        return view('dashboard', compact('areas', 'reservations', 'user'));
    }
}
