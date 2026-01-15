<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReservationController extends Controller
{
    public function index()
    {
        $areas = Area::orderBy('name')->get();
        $reservations = Reservation::with('area')
            ->where('user_id', Auth::id())
            ->orderByDesc('start_time')
            ->get();

        return view('user.reservations.index', compact('areas', 'reservations'));
    }

    public function store(Request $request)
    {
        if ($request->has(['reservation_date', 'time_start', 'time_end'])) {
            $request->merge([
                'start_time' => $request->reservation_date . ' ' . $request->time_start,
                'end_time' => $request->reservation_date . ' ' . $request->time_end,
            ]);
        }

        $validated = $request->validate([
            'area_id' => ['required', 'exists:areas,id'],
            'start_time' => ['required', 'date', 'after:now'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'attendees' => ['nullable', 'integer', 'min:1']
        ]);

        $area = Area::findOrFail($validated['area_id']);

        if ($area->max_capacity && ($validated['attendees'] ?? 1) > $area->max_capacity) {
            return back()->withErrors(['attendees' => 'Se superó la capacidad máxima del área.']);
        }

        if ($area->hasConflict($validated['start_time'], $validated['end_time'])) {
            return back()->withErrors(['start_time' => 'El horario seleccionado ya está reservado.']);
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'area_id' => $area->id,
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'attendees' => $validated['attendees'] ?? null,
            'status' => 'pendiente',
        ]);

        return redirect()->route('reservations.index')->with('status', 'Reserva creada y enviada para aprobación.');
    }

    public function destroy(Reservation $reservation)
    {
        Gate::authorize('delete', $reservation);
        $reservation->delete();

        return back()->with('status', 'Reserva cancelada.');
    }
}
