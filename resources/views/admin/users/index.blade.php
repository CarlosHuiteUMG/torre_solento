@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-semibold">Usuarios</h2>
    <a href="{{ route('admin.users.create') }}" class="bg-indigo-600 text-white px-3 py-2 rounded">Nuevo</a>
</div>
<div class="bg-white rounded shadow">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">Nombre</th>
                <th class="text-left">Correo</th>
                <th class="text-left">Rol</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-b">
                    <td class="py-2">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
                    <td class="flex space-x-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600">Editar</a>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
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
