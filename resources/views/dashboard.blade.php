@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="md:col-span-2 bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-2">Disponibilidad</h2>
        <div id='calendar'></div>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-md font-semibold mb-2">Crear reserva</h3>
        <form action="{{ route('reservations.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm font-medium">Área</label>
                <select name="area_id" class="w-full border-gray-300 rounded">
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">Inicio</label>
                <input type="datetime-local" name="start_time" class="w-full border-gray-300 rounded">
            </div>
            <div>
                <label class="block text-sm font-medium">Fin</label>
                <input type="datetime-local" name="end_time" class="w-full border-gray-300 rounded">
            </div>
            <div>
                <label class="block text-sm font-medium">Asistentes (para gimnasio)</label>
                <input type="number" name="attendees" min="1" class="w-full border-gray-300 rounded">
            </div>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded">Reservar</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            events: [
                @foreach($reservations as $reservation)
                {
                    title: '{{ $reservation->area->name }} - {{ $reservation->user->name }} ({{ $reservation->status }})',
                    start: '{{ $reservation->start_time }}',
                    end: '{{ $reservation->end_time }}'
                },
                @endforeach
            ]
        });
        calendar.render();
    });
</script>
@endsection
