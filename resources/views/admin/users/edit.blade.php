@extends('layouts.app')

@section('content')
<h2 class="text-lg font-semibold mb-4">Editar usuario</h2>
<form method="POST" action="{{ route('admin.users.update', $user) }}" class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white p-4 rounded shadow">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm font-medium">Nombre</label>
        <input name="name" value="{{ $user->name }}" class="w-full border-gray-300 rounded" />
    </div>
    <div>
        <label class="block text-sm font-medium">Correo</label>
        <input name="email" value="{{ $user->email }}" class="w-full border-gray-300 rounded" />
    </div>
    <div>
        <label class="block text-sm font-medium">Contraseña (dejar en blanco para mantener)</label>
        <input type="password" name="password" class="w-full border-gray-300 rounded" />
    </div>
    <div>
        <label class="block text-sm font-medium">Rol</label>
        <select name="role" class="w-full border-gray-300 rounded">
            <option value="admin" @selected($user->hasRole('admin'))>Administrador</option>
            <option value="residente" @selected($user->hasRole('residente'))>Residente</option>
        </select>
    </div>
    <div class="md:col-span-2">
        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Actualizar</button>
    </div>
</form>
@endsection
