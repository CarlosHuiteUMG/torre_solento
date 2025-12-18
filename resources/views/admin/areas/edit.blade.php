@extends('layouts.app')

@section('content')
<h2 class="text-lg font-semibold mb-4">Editar área</h2>
<form method="POST" action="{{ route('admin.areas.update', $area) }}" class="space-y-4 bg-white p-4 rounded shadow">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm font-medium">Nombre</label>
        <input name="name" value="{{ $area->name }}" class="w-full border-gray-300 rounded" />
    </div>
    <div>
        <label class="block text-sm font-medium">Capacidad máxima</label>
        <input type="number" name="max_capacity" value="{{ $area->max_capacity }}" class="w-full border-gray-300 rounded" />
    </div>
    <div>
        <label class="block text-sm font-medium">Descripción</label>
        <textarea name="description" class="w-full border-gray-300 rounded">{{ $area->description }}</textarea>
    </div>
    <button class="bg-indigo-600 text-white px-4 py-2 rounded">Actualizar</button>
</form>
@endsection
