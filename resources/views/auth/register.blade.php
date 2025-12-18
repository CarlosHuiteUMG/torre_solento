@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Registro de residente</h2>
    <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Nombre de usuario</label>
            <input name="name" class="w-full border-gray-300 rounded" required />
        </div>
        <div>
            <label class="block text-sm font-medium">Correo</label>
            <input type="email" name="email" class="w-full border-gray-300 rounded" required />
        </div>
        <div>
            <label class="block text-sm font-medium">Contraseña</label>
            <input type="password" name="password" class="w-full border-gray-300 rounded" required />
        </div>
        <div>
            <label class="block text-sm font-medium">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="w-full border-gray-300 rounded" required />
        </div>
        <div>
            <label class="block text-sm font-medium">Nombre completo</label>
            <input name="full_name" class="w-full border-gray-300 rounded" required />
        </div>
        <div>
            <label class="block text-sm font-medium">DPI</label>
            <input name="dpi" class="w-full border-gray-300 rounded" required />
        </div>
        <div>
            <label class="block text-sm font-medium">Número de apartamento</label>
            <input name="apartment_number" class="w-full border-gray-300 rounded" required />
        </div>
        <div>
            <label class="block text-sm font-medium">Nivel o piso</label>
            <input name="floor" class="w-full border-gray-300 rounded" required />
        </div>
        <div>
            <label class="block text-sm font-medium">Tipo de residente</label>
            <select name="resident_type" class="w-full border-gray-300 rounded">
                <option value="propietario">Propietario</option>
                <option value="inquilino">Inquilino</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium">Teléfono</label>
            <input name="phone" class="w-full border-gray-300 rounded" required />
        </div>
        <div class="md:col-span-2">
            <button class="w-full bg-indigo-600 text-white py-2 rounded">Crear cuenta</button>
        </div>
    </form>
</div>
@endsection
