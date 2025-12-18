<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <a class="text-xl font-semibold" href="/">{{ config('app.name') }}</a>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium">Inicio</a>
                    <a href="{{ route('reservations.index') }}" class="text-sm font-medium">Mis reservas</a>
                    <a href="{{ route('profile.edit') }}" class="text-sm font-medium">Perfil</a>
                    @role('admin')
                        <a href="{{ route('admin.users.index') }}" class="text-sm font-medium">Administración</a>
                    @endrole
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm font-medium text-red-600">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium">Ingresar</a>
                    <a href="{{ route('register') }}" class="text-sm font-medium">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>
    <main class="max-w-6xl mx-auto p-4">
        @if(session('status'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">{{ session('status') }}</div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{ $slot ?? '' }}
        @yield('content')
    </main>
</body>
</html>
