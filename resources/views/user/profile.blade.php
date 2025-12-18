@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Mi perfil</h2>
    <form method="POST" action="{{ route('profile.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium">Nombre completo</label>
            <input type="text" name="full_name" value="{{ old('full_name', $profile->full_name) }}" class="w-full border-gray-300 rounded">
        </div>
        <div>
            <label class="block text-sm font-medium">DPI</label>
            <input type="text" name="dpi" value="{{ old('dpi', $profile->dpi) }}" class="w-full border-gray-300 rounded">
        </div>
        <div>
            <label class="block text-sm font-medium">Número de apartamento</label>
            <input type="text" name="apartment_number" value="{{ old('apartment_number', $profile->apartment_number) }}" class="w-full border-gray-300 rounded">
        </div>
        <div>
            <label class="block text-sm font-medium">Nivel o piso</label>
            <input type="text" name="floor" value="{{ old('floor', $profile->floor) }}" class="w-full border-gray-300 rounded">
        </div>
        <div>
            <label class="block text-sm font-medium">Tipo de residente</label>
            <select name="resident_type" class="w-full border-gray-300 rounded">
                <option value="propietario" @selected($profile->resident_type === 'propietario')>Propietario</option>
                <option value="inquilino" @selected($profile->resident_type === 'inquilino')>Inquilino</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium">Teléfono</label>
            <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="w-full border-gray-300 rounded">
        </div>
        <div class="md:col-span-2">
            <button class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
        </div>
    </form>
</div>
@endsection
