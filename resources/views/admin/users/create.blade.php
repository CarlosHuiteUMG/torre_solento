@extends('layouts.app')

@section('content')
<h2 class="text-lg font-semibold mb-4">Crear usuario</h2>
<form method="POST" action="{{ route('admin.users.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white p-4 rounded shadow">
    @csrf
    <div>
        <label class="block text-sm font-medium">Nombre</label>
        <input name="name" class="w-full border-gray-300 rounded" />
    </div>
    <div>
        <label class="block text-sm font-medium">Correo</label>
        <input name="email" class="w-full border-gray-300 rounded" />
    </div>
    <div>
        <label class="block text-sm font-medium">Contraseña</label>
        <input type="password" name="password" class="w-full border-gray-300 rounded" />
    </div>
    <div>
        <label class="block text-sm font-medium">Rol</label>
        <select name="role" class="w-full border-gray-300 rounded">
            <option value="admin">Administrador</option>
            <option value="residente">Residente</option>
        </select>
    </div>
    <div class="md:col-span-2">
        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
    </div>
</form>
@endsection
