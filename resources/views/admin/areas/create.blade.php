@extends('layouts.app')

@section('content')
<h2 class="text-lg font-semibold mb-4">Crear área</h2>
<form method="POST" action="{{ route('admin.areas.store') }}" class="space-y-4 bg-white p-4 rounded shadow">
    @csrf
    <div>
        <label class="block text-sm font-medium">Nombre</label>
        <input name="name" class="w-full border-gray-300 rounded" />
    </div>
    <div>
        <label class="block text-sm font-medium">Capacidad máxima</label>
        <input type="number" name="max_capacity" class="w-full border-gray-300 rounded" />
    </div>
    <div>
        <label class="block text-sm font-medium">Descripción</label>
        <textarea name="description" class="w-full border-gray-300 rounded"></textarea>
    </div>
    <button class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
</form>
@endsection
