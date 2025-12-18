@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Ingresar</h2>
    <form method="POST" action="{{ route('login') }}" class="space-y-3">
        @csrf
        <div>
            <label class="block text-sm font-medium">Correo</label>
            <input type="email" name="email" class="w-full border-gray-300 rounded" required />
        </div>
        <div>
            <label class="block text-sm font-medium">Contraseña</label>
            <input type="password" name="password" class="w-full border-gray-300 rounded" required />
        </div>
        <div class="flex items-center">
            <input type="checkbox" name="remember" class="mr-2">
            <span class="text-sm">Recordarme</span>
        </div>
        <button class="w-full bg-indigo-600 text-white py-2 rounded">Ingresar</button>
    </form>
</div>
@endsection
