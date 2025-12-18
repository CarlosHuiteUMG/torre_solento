<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationAdminController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('area', 'user')
            ->orderByDesc('start_time')
            ->paginate();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pendiente,aprobada,rechazada']
        ]);

        $reservation->update(['status' => $validated['status']]);

        return back()->with('status', 'Reserva actualizada');
    }
}
