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
            // Show all reservations for the calendar so users can see availability
            // Filter by date range (e.g., from start of current month) can be added later if needed
            $reservations = Reservation::with('area', 'user')
                ->where('created_at', '>=', now()->subMonths(6)) // Optional: optimizations
                ->get();
        }

        return view('dashboard', compact('areas', 'reservations', 'user', 'images'));
    }
}
