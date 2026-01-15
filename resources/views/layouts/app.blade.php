<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f4ff',
                            100: '#e0e7ff',
                            500: '#3b82f6',
                            600: '#2563eb', // Standard Blue
                            700: '#1d4ed8',
                            800: '#1e40af', // Deep Blue
                            900: '#1e3a8a', // Darker Blue
                        },
                        secondary: {
                            100: '#ffedd5',
                            500: '#f97316', // Orange
                            600: '#ea580c', // Darker Orange
                        },
                        background: '#f8fafc', // Light Gray/Blueish White
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Custom scrollbar for a more premium feel */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-background text-slate-800 font-sans antialiased min-h-screen flex flex-col">
    <nav class="bg-primary-900 border-b border-primary-800 shadow-lg relative z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="/"
                            class="text-2xl font-bold text-white tracking-tight hover:text-secondary-500 transition duration-300">
                            {{ config('app.name') }}
                        </a>
                    </div>
                    <!-- Desktop Menu -->
                    <div class="hidden sm:ml-8 sm:flex sm:space-x-8">
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="border-transparent text-gray-300 hover:border-secondary-500 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                                <span class="group-hover:translate-x-1 transition-transform">Inicio</span>
                            </a>
                            <a href="{{ route('reservations.index') }}"
                                class="border-transparent text-gray-300 hover:border-secondary-500 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">Mis
                                reservas</a>
                            <a href="{{ route('profile.edit') }}"
                                class="border-transparent text-gray-300 hover:border-secondary-500 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">Perfil</a>
                            @role('admin')
                            <a href="{{ route('admin.users.index') }}"
                                class="border-transparent text-gray-300 hover:border-secondary-500 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">Administración</a>
                            @endrole
                        @endauth
                    </div>
                </div>

                <!-- Right Side Actions -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="bg-secondary-600 hover:bg-secondary-500 text-white px-5 py-2 rounded-full text-sm font-medium transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Salir
                            </button>
                        </form>
                    @else
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('login') }}"
                                class="text-gray-300 hover:text-white font-medium transition px-3 py-2 rounded-md hover:bg-white/10">Ingresar</a>
                            <a href="{{ route('register') }}"
                                class="bg-secondary-600 hover:bg-secondary-500 text-white px-5 py-2 rounded-full text-sm font-medium transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Registrarse
                            </a>
                        </div>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-white/10 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div :class="{'block': open, 'hidden': ! open}"
            class="hidden sm:hidden bg-primary-800 border-t border-primary-700 absolute w-full shadow-xl"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">
            <div class="pt-2 pb-3 space-y-1 px-2">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="block pl-3 pr-4 py-3 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/10 transition duration-150 ease-in-out">Inicio</a>
                    <a href="{{ route('reservations.index') }}"
                        class="block pl-3 pr-4 py-3 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/10 transition duration-150 ease-in-out">Mis
                        reservas</a>
                    <a href="{{ route('profile.edit') }}"
                        class="block pl-3 pr-4 py-3 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/10 transition duration-150 ease-in-out">Perfil</a>
                    @role('admin')
                    <a href="{{ route('admin.users.index') }}"
                        class="block pl-3 pr-4 py-3 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/10 transition duration-150 ease-in-out">Administración</a>
                    @endrole
                    <div class="border-t border-primary-700 my-2"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            class="w-full text-left pl-3 pr-4 py-3 rounded-md text-base font-medium text-red-400 hover:text-red-300 hover:bg-white/10 transition">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block pl-3 pr-4 py-3 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-white/10 transition duration-150 ease-in-out">Ingresar</a>
                    <a href="{{ route('register') }}"
                        class="block pl-3 pr-4 py-3 rounded-md text-base font-medium text-secondary-400 hover:text-secondary-300 hover:bg-white/10 transition duration-150 ease-in-out">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>

    @yield('hero')

    <main class="flex-grow py-10 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Alerts -->
            @if(session('status'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 mb-6 shadow-md rounded-r-lg" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-emerald-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-emerald-700 font-medium">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 border-l-4 border-rose-500 p-4 mb-6 shadow-md rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-rose-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-rose-800">Se encontraron errores:</h3>
                            <ul class="mt-2 list-disc list-inside text-sm text-rose-700">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
            </p>
        </div>
    </footer>
</body>

</html>