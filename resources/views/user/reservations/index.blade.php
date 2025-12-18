@extends('layouts.app')

@section('content')
<div class="bg-white p-4 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Mis reservas</h2>
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">Área</th>
                <th class="text-left">Inicio</th>
                <th class="text-left">Fin</th>
                <th class="text-left">Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr class="border-b">
                    <td class="py-2">{{ $reservation->area->name }}</td>
                    <td>{{ $reservation->start_time }}</td>
                    <td>{{ $reservation->end_time }}</td>
                    <td>{{ ucfirst($reservation->status) }}</td>
                    <td>
                        <form method="POST" action="{{ route('reservations.destroy', $reservation) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600">Cancelar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="py-4">No tienes reservas aún.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
