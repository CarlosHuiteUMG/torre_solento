<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $images = [];

        // Get images for carousel
        if (File::exists(public_path('images'))) {
            $files = File::files(public_path('images'));
            foreach ($files as $file) {
                // Return relative path for asset() or direct usage
                $images[] = 'images/' . $file->getFilename();
            }
        }

        $areas = Area::orderBy('name')->get();

        // Only fetch reservations if user is logged in
        $reservations = collect();
        if ($user) {
            $reservations = Reservation::with('area', 'user')
                ->upcoming()
                ->forUserOrAdmin($user)
                ->get();
        }

        return view('dashboard', compact('areas', 'reservations', 'user', 'images'));
    }
}
