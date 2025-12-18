@extends('layouts.app')

@section('content')
<h2 class="text-lg font-semibold mb-4">Reservas</h2>
<div class="bg-white rounded shadow">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">Área</th>
                <th class="text-left">Residente</th>
                <th class="text-left">Inicio</th>
                <th class="text-left">Fin</th>
                <th class="text-left">Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr class="border-b">
                    <td class="py-2">{{ $reservation->area->name }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->start_time }}</td>
                    <td>{{ $reservation->end_time }}</td>
                    <td>{{ ucfirst($reservation->status) }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.reservations.update-status', $reservation) }}" class="flex space-x-2">
                            @csrf
                            @method('PUT')
                            <select name="status" class="border-gray-300 rounded">
                                <option value="pendiente" @selected($reservation->status==='pendiente')>Pendiente</option>
                                <option value="aprobada" @selected($reservation->status==='aprobada')>Aprobada</option>
                                <option value="rechazada" @selected($reservation->status==='rechazada')>Rechazada</option>
                            </select>
                            <button class="bg-indigo-600 text-white px-3 py-1 rounded">Actualizar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
