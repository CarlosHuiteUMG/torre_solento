@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-semibold">Áreas comunes</h2>
    <a href="{{ route('admin.areas.create') }}" class="bg-indigo-600 text-white px-3 py-2 rounded">Nueva área</a>
</div>
<div class="bg-white rounded shadow">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">Nombre</th>
                <th class="text-left">Capacidad</th>
                <th class="text-left">Descripción</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($areas as $area)
                <tr class="border-b">
                    <td class="py-2">{{ $area->name }}</td>
                    <td>{{ $area->max_capacity ?? 'No definida' }}</td>
                    <td>{{ $area->description }}</td>
                    <td class="flex space-x-2">
                        <a href="{{ route('admin.areas.edit', $area) }}" class="text-indigo-600">Editar</a>
                        <form method="POST" action="{{ route('admin.areas.destroy', $area) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
