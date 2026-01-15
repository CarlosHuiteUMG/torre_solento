@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl bg-white p-8 rounded-xl shadow-lg border border-slate-100 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-secondary-500 to-primary-600"></div>

            <div class="mb-8 border-b border-gray-100 pb-4">
                <h2 class="text-2xl font-bold text-gray-900">Registro de Residente</h2>
                <p class="mt-1 text-sm text-gray-500">Complete la información para crear su cuenta de acceso.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf

                <!-- Account Info Section -->
                <div class="md:col-span-2">
                    <h3
                        class="text-sm font-semibold text-primary-800 uppercase tracking-wider mb-4 bg-primary-50 p-2 rounded">
                        Información de Cuenta</h3>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre de usuario</label>
                    <input name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow @error('name') border-red-500 @enderror"
                        placeholder="ej. jdoe" required />
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Correo Electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow @error('email') border-red-500 @enderror"
                        placeholder="ej. correo@ejemplo.com" required />
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Contraseña</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow @error('password') border-red-500 @enderror"
                        placeholder="••••••••" required />
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow"
                        placeholder="••••••••" required />
                </div>

                <!-- Personal Info Section -->
                <div class="md:col-span-2 mt-4">
                    <h3
                        class="text-sm font-semibold text-primary-800 uppercase tracking-wider mb-4 bg-primary-50 p-2 rounded">
                        Información Personal</h3>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre completo</label>
                    <input name="full_name" value="{{ old('full_name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow @error('full_name') border-red-500 @enderror"
                        placeholder="Nombre completo del residente" required />
                    @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">DPI (Documento de Identificación)</label>
                    <input name="dpi" value="{{ old('dpi') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow @error('dpi') border-red-500 @enderror"
                        required />
                    @error('dpi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                    <input name="phone" value="{{ old('phone') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow @error('phone') border-red-500 @enderror"
                        required />
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Residence Info Section -->
                <div class="md:col-span-2 mt-4">
                    <h3
                        class="text-sm font-semibold text-primary-800 uppercase tracking-wider mb-4 bg-primary-50 p-2 rounded">
                        Información de Residencia</h3>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Número de apartamento</label>
                    <input name="apartment_number" value="{{ old('apartment_number') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow @error('apartment_number') border-red-500 @enderror"
                        required />
                    @error('apartment_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nivel o piso</label>
                    <input name="floor" value="{{ old('floor') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow @error('floor') border-red-500 @enderror"
                        required />
                    @error('floor') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tipo de residente</label>
                    <select name="resident_type"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-shadow bg-white">
                        <option value="propietario" @selected(old('resident_type') == 'propietario')>Propietario</option>
                        <option value="inquilino" @selected(old('resident_type') == 'inquilino')>Inquilino</option>
                    </select>
                </div>

                <div class="md:col-span-2 mt-6">
                    <button
                        class="w-full bg-secondary-600 hover:bg-secondary-500 text-white font-bold py-3 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-500">
                        Crear cuenta
                    </button>
                    <p class="text-center text-sm text-gray-500 mt-4">
                        ¿Ya tienes una cuenta? <a href="{{ route('login') }}"
                            class="font-medium text-primary-600 hover:text-primary-500">Inicia sesión</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection