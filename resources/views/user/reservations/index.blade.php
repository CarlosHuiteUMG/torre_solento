@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Mis reservas</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-3 py-2 text-left font-medium text-gray-500 whitespace-nowrap">Área</th>
                        <th class="px-3 py-2 text-left font-medium text-gray-500 whitespace-nowrap">Inicio</th>
                        <th class="px-3 py-2 text-left font-medium text-gray-500 whitespace-nowrap">Fin</th>
                        <th class="px-3 py-2 text-left font-medium text-gray-500 whitespace-nowrap">Estado</th>
                        <th class="px-3 py-2"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($reservations as $reservation)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $reservation->area->name }}
                                    </td>
                                    <td class="px-3 py-3 text-gray-600 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($reservation->start_time)->format('d/m/Y H:i') }}</td>
                                    <td class="px-3 py-3 text-gray-600 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($reservation->end_time)->format('d/m/Y H:i') }}</td>
                                    <td class="px-3 py-3 whitespace-nowrap">
                                        @php
                                            $statusClasses = match ($reservation->status) {
                                                'confirmed' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                                'en_curso' => 'bg-blue-100 text-blue-800',
                                                'finalizada' => 'bg-gray-100 text-gray-800',
                                                default => 'bg-yellow-100 text-yellow-800', // Pending
                                            };
                                            
                                            $statusLabels = match ($reservation->status) {
                                                'confirmed' => 'Confirmada',
                                                'cancelled' => 'Cancelada',
                                                'en_curso' => 'En Curso',
                                                'finalizada' => 'Finalizada',
                                                default => 'Pendiente',
                                            };
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses }}">
                                            {{ $statusLabels }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-3 text-right whitespace-nowrap">
                                        @if (in_array($reservation->status, ['pendiente', 'confirmed']))
                                            <form method="POST" action="{{ route('reservations.destroy', $reservation) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="bg-white border border-red-300 text-red-600 hover:bg-red-50 hover:text-red-700 font-semibold py-1 px-3 rounded-md text-xs transition duration-150 ease-in-out shadow-sm">
                                                    Cancelar
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-4 text-center text-gray-500">No tienes reservas aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection