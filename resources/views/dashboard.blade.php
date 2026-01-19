@extends('layouts.app')

@section('hero')
    @guest
        <!-- Carousel Section for Guests -->
        <div class="relative w-full h-[calc(100vh-65px)] overflow-hidden" x-data="{ 
                                                                            activeSlide: 0, 
                                                                            slides: {{ json_encode($images) }}, 
                                                                            autoSlideInterval: null,
                                                                            startAutoSlide() { 
                                                                                this.autoSlideInterval = setInterval(() => { 
                                                                                    this.activeSlide = (this.activeSlide + 1) % this.slides.length 
                                                                                }, 4000); 
                                                                            },
                                                                            stopAutoSlide() {
                                                                                clearInterval(this.autoSlideInterval);
                                                                            }
                                                                         }" x-init="startAutoSlide()"
            @mouseenter="stopAutoSlide()" @mouseleave="startAutoSlide()">

            <!-- Slides -->
            <div class="relative w-full h-full bg-slate-900">
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0 transform scale-105"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full">
                        <img :src="slide" alt="Torre Solento" class="w-full h-full object-cover">
                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    </div>
                </template>

                <!-- Empty State if no images -->
                <div x-show="slides.length === 0" class="flex items-center justify-center h-full text-gray-500">
                    <p>No hay imágenes disponibles</p>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1"
                class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/10 hover:bg-white/30 text-white p-3 rounded-full backdrop-blur-sm transition hidden md:block z-20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button @click="activeSlide = (activeSlide + 1) % slides.length"
                class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/10 hover:bg-white/30 text-white p-3 rounded-full backdrop-blur-sm transition hidden md:block z-20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Indicators -->
            <div class="absolute bottom-6 left-0 right-0 flex justify-center space-x-2 z-20">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="activeSlide = index"
                        :class="{'bg-secondary-500 w-8': activeSlide === index, 'bg-white/50 w-2': activeSlide !== index}"
                        class="h-2 rounded-full transition-all duration-300 shadow-sm"></button>
                </template>
            </div>

            <!-- Welcome Text Overlay -->
            <div
                class="absolute bottom-0 left-0 right-0 p-8 md:p-16 text-white text-center md:text-left z-20 bg-gradient-to-t from-black/60 to-transparent">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4 tracking-tight drop-shadow-xl">Bienvenidos a Torre Solento
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-100 mb-8 drop-shadow-lg max-w-2xl">Exclusividad, seguridad y confort
                        en cada espacio.</p>
                    <div class="flex flex-col md:flex-row gap-4 justify-center md:justify-start">
                        <a href="{{ route('login') }}"
                            class="bg-secondary-600 hover:bg-secondary-500 text-white font-semibold py-4 px-10 rounded-full shadow-xl transition transform hover:-translate-y-1 text-lg">
                            Ingresar al Portal
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-white/20 hover:bg-white/30 text-white font-semibold py-4 px-10 rounded-full shadow-xl transition transform hover:-translate-y-1 backdrop-blur-sm text-lg border border-white/40">
                            Registrarse
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection

@section('content')

    @auth
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Calendar Section -->
            <div class="lg:col-span-2 bg-white p-3 md:p-6 rounded-xl shadow-sm border border-slate-100 h-fit">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Disponibilidad de Áreas
                    </h2>
                    <span class="text-xs font-semibold px-2 py-1 bg-primary-50 text-primary-700 rounded-md">Vista Mensual</span>
                </div>

                <div x-data="{ 
                        showModal: false, 
                        modalDate: '', 
                        modalEvents: [],
                        openModal(date, events) {
                            this.modalDate = date;
                            this.modalEvents = events;
                            this.showModal = true;
                        }
                    }" 
                    @open-calendar-modal.window="openModal($event.detail.date, $event.detail.events)"
                    class="relative">
                    
                    <div id='calendar' class="calendar-custom font-sans z-0 relative"></div>

                    <!-- Event Summary Modal -->
                    <div x-show="showModal" style="display: none;" 
                        class="fixed inset-0 z-50 overflow-y-auto" 
                        aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        
                        <!-- Backdrop -->
                        <div x-show="showModal" 
                            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                            @click="showModal = false"></div>

                        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                            <div x-show="showModal" 
                                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg w-full">
                                
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Eventos para el <span x-text="modalDate"></span>
                                            </h3>
                                            <div class="mt-4 max-h-60 overflow-y-auto">
                                                <template x-if="modalEvents.length === 0">
                                                    <p class="text-gray-500 text-sm italic">No hay reservas para este día.</p>
                                                </template>
                                                
                                                <ul class="divide-y divide-gray-200">
                                                    <template x-for="event in modalEvents" :key="event.id">
                                                        <li class="py-3 flex justify-between items-center">
                                                            <div class="text-left">
                                                                <p class="text-sm font-semibold text-gray-800" x-text="event.title"></p>
                                                                <p class="text-xs text-gray-500">
                                                                    <span x-text="event.status"></span> • <span x-text="event.user"></span>
                                                                </p>
                                                            </div>
                                                            <div class="text-sm text-gray-600 font-mono">
                                                                <span x-text="event.start"></span> - <span x-text="event.end"></span>
                                                            </div>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" 
                                        @click="showModal = false">
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reservation Form Section -->
            <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-secondary-500 h-fit sticky top-24">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Nueva Reserva
                </h3>

                <form action="{{ route('reservations.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Área Común</label>
                        <div class="relative">
                            <select name="area_id"
                                class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 appearance-none bg-white transition-shadow cursor-pointer">
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                                        {{ $area->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha</label>
                        <input type="date" name="reservation_date" value="{{ old('reservation_date', date('Y-m-d')) }}"
                            class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 appearance-none bg-white transition-shadow text-gray-900 cursor-pointer"
                            required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="col-span-1 sm:border-r border-gray-100 sm:pr-2">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Hora
                                Inicio</label>
                            <div class="relative">
                                <input type="text" name="time_start" value="{{ old('time_start') }}"
                                    class="timepicker w-full py-2 border-0 border-b-2 border-slate-200 focus:border-secondary-500 focus:ring-0 px-0 transition-colors bg-transparent text-sm font-medium text-gray-900 placeholder-gray-400"
                                    placeholder="Seleccionar hora..." required>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-1 sm:pl-2 mt-4 sm:mt-0">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Hora Fin</label>
                            <div class="relative">
                                <input type="text" name="time_end" value="{{ old('time_end') }}"
                                    class="timepicker w-full py-2 border-0 border-b-2 border-slate-200 focus:border-secondary-500 focus:ring-0 px-0 transition-colors bg-transparent text-sm font-medium text-gray-900 placeholder-gray-400"
                                    placeholder="Seleccionar hora..." required>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Asistentes <span
                                class="font-normal text-gray-500 text-xs">(aprox.)</span></label>
                        <input type="number" name="attendees" min="1" value="{{ old('attendees', 1) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 transition-shadow"
                            placeholder="Cantidad de personas">
                    </div>

                    <button
                        class="w-full bg-primary-800 hover:bg-primary-900 text-white font-bold py-3 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 mt-4 flex justify-center items-center">
                        <span>Confirmar Reserva</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <style>
            /* Custom FullCalendar Styles to match theme */
            .fc-theme-standard .fc-scrollgrid {
                border-color: #f1f5f9;
            }

            .fc-col-header-cell {
                background-color: #f8fafc;
                padding: 8px 0;
                color: #475569;
                font-weight: 600;
                font-size: 0.85rem;
            }

            .fc-daygrid-day-number {
                color: #334155;
                font-weight: 500;
            }

            .fc-day-today {
                background-color: #eff6ff !important;
            }

            .fc-button-primary {
                background-color: #1e3a8a !important;
                border-color: #1e3a8a !important;
            }

            .fc-button-primary:hover {
                background-color: #1e40af !important;
                border-color: #1e40af !important;
            }

            .fc-event {
                border-radius: 4px;
                padding: 2px 4px;
                font-size: 0.8rem;
                border: none;
            }

            /* Mobile Responsiveness for Calendar */
            @media (max-width: 640px) {
                .fc-header-toolbar {
                    flex-direction: column;
                    gap: 0.5rem;
                    margin-bottom: 1rem !important;
                }

                .fc-toolbar-chunk {
                    display: flex;
                    justify-content: center;
                    width: 100%;
                }

                .fc-toolbar-title {
                    font-size: 1.1rem !important;
                    text-align: center;
                }

                .fc-button {
                    padding: 0.3rem 0.6rem !important;
                    font-size: 0.75rem !important;
                }

                /* Ensure day text doesn't overflow */
                .fc-col-header-cell-cushion {
                    font-size: 0.75rem;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Pass reservations to JS
                const existingReservations = @json($reservations);

                // Initialize Flatpickr for Time Selection
                const timeStartPicker = flatpickr("input[name='time_start']", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    altInput: true,
                    altFormat: "h:i K",
                    time_24hr: false,
                    locale: "es"
                });

                const timeEndPicker = flatpickr("input[name='time_end']", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    altInput: true,
                    altFormat: "h:i K",
                    time_24hr: false,
                    locale: "es"
                });

                // Function to update disabled times based on selected area and date
                function updateAvailableTimes() {
                    const areaSelect = document.querySelector("select[name='area_id']");
                    const dateInput = document.querySelector("input[name='reservation_date']");

                    if (!areaSelect || !dateInput) return;

                    const areaId = areaSelect.value;
                    const dateVal = dateInput.value;

                    if (!dateVal) return;

                    // Filter reservations for the selected area and date
                    const bookedTimes = existingReservations.filter(res => {
                        // Extract date part from start_time (assuming "YYYY-MM-DD HH:mm:ss")
                        const resDate = res.start_time.split(' ')[0];
                        // Also check status if needed (e.g. ignore cancelled)
                        return res.area_id == areaId && resDate === dateVal && res.status !== 'cancelled';
                    }).map(res => {
                        // Extract time parts for disable ranges
                        const startTime = res.start_time.split(' ')[1].substring(0, 5); // HH:mm
                        const endTime = res.end_time.split(' ')[1].substring(0, 5);     // HH:mm
                        return { from: startTime, to: endTime };
                    });

                    // Update Flatpickr instances
                    if (timeStartPicker) timeStartPicker.set('disable', bookedTimes);
                    if (timeEndPicker) timeEndPicker.set('disable', bookedTimes);
                }

                // Add Event Listeners
                const areaSelect = document.querySelector("select[name='area_id']");
                const dateInput = document.querySelector("input[name='reservation_date']");

                if (areaSelect) areaSelect.addEventListener('change', updateAvailableTimes);
                if (dateInput) dateInput.addEventListener('change', updateAvailableTimes);

                // Run once on load to set initial state
                updateAvailableTimes();

                const calendarEl = document.getElementById('calendar');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'es',
                    height: 'auto',
                    dayMaxEvents: true, // Allow "more" link when too many events
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    buttonText: {
                        today: 'Hoy',
                        month: 'Mes',
                        week: 'Semana',
                        day: 'Día'
                    },
                    events: [
                        @foreach($reservations as $reservation)
                            {
                                id: '{{ $reservation->id }}',
                                title: '{{ $reservation->area->name }}',
                                start: '{{ $reservation->start_time }}',
                                end: '{{ $reservation->end_time }}',
                                color: '{{ $reservation->status == "confirmed" ? "#10b981" : ($reservation->status == "cancelled" ? "#ef4444" : "#f59e0b") }}', 
                                extendedProps: {
                                    user: '{{ $reservation->user->name }}',
                                    status: '{{ $reservation->status }}'
                                }
                            },
                        @endforeach
                    ],
                    eventDidMount: function (info) {
                        info.el.title = info.event.extendedProps.user + ' (' + info.event.extendedProps.status + ')';
                    },
                    dateClick: function(info) {
                        // Get events for this specific day
                        const dateStr = info.dateStr; // YYYY-MM-DD
                        const eventsForDay = calendar.getEvents().filter(event => {
                             // Compare only the YYYY-MM-DD part
                             const eventDate = event.startStr.substring(0, 10);
                             return eventDate === dateStr;
                        }).map(event => {
                            // Extract pretty time
                            const startDate = new Date(event.start);
                            const endDate = new Date(event.end);
                            const timeFormat = { hour: '2-digit', minute: '2-digit', hour12: false };
                            
                            return {
                                id: event.id,
                                title: event.title,
                                user: event.extendedProps.user,
                                status: event.extendedProps.status,
                                start: startDate.toLocaleTimeString([], timeFormat),
                                end: endDate.toLocaleTimeString([], timeFormat)
                            };
                        });

                        // Dispatch event to open Alpine Modal
                        window.dispatchEvent(new CustomEvent('open-calendar-modal', {
                            detail: {
                                date: info.date.toLocaleDateString('es-ES', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }),
                                events: eventsForDay
                            }
                        }));
                    }
                });
                calendar.render();
            });
        </script>
    @endauth

@endsection