

<?php $__env->startSection('content'); ?>

    <?php if(auth()->guard()->guest()): ?>
        <!-- Carousel Section for Guests -->
        <div class="relative w-full h-[calc(100vh-65px)] overflow-hidden" x-data="{ 
                    activeSlide: 0, 
                    slides: <?php echo e(json_encode($images)); ?>, 
                    autoSlideInterval: null,
                    startAutoSlide() { 
                        this.autoSlideInterval = setInterval(() => { 
                            this.activeSlide = (this.activeSlide + 1) % this.slides.length 
                        }, 4000); 
                    },
                    stopAutoSlide() {
                        clearInterval(this.autoSlideInterval);
                    }
                 }" x-init="startAutoSlide()" @mouseenter="stopAutoSlide()" @mouseleave="startAutoSlide()">

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
                class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/10 hover:bg-white/30 text-white p-3 rounded-full backdrop-blur-sm transition hidden md:block">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button @click="activeSlide = (activeSlide + 1) % slides.length"
                class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/10 hover:bg-white/30 text-white p-3 rounded-full backdrop-blur-sm transition hidden md:block">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Indicators -->
            <div class="absolute bottom-6 left-0 right-0 flex justify-center space-x-2 z-10">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="activeSlide = index"
                        :class="{'bg-secondary-500 w-8': activeSlide === index, 'bg-white/50 w-2': activeSlide !== index}"
                        class="h-2 rounded-full transition-all duration-300"></button>
                </template>
            </div>

            <!-- Welcome Text Overlay -->
            <div class="absolute bottom-0 left-0 right-0 p-8 md:p-16 text-white text-center md:text-left">
                <div class="max-w-3xl">
                    <h1 class="text-3xl md:text-5xl font-bold mb-4 tracking-tight shadow-black drop-shadow-lg">Bienvenidos a
                        Torre Solento</h1>
                    <p class="text-lg md:text-xl text-gray-200 mb-8 drop-shadow-md">Exclusividad, seguridad y confort en cada
                        espacio.</p>
                    <div class="flex flex-col md:flex-row gap-4 justify-center md:justify-start">
                        <a href="<?php echo e(route('login')); ?>"
                            class="bg-secondary-600 hover:bg-secondary-500 text-white font-semibold py-3 px-8 rounded-full shadow-lg transition transform hover:-translate-y-1 border border-transparent">
                            Ingresar al Portal
                        </a>
                        <a href="<?php echo e(route('register')); ?>"
                            class="bg-transparent hover:bg-white/10 text-white font-semibold py-3 px-8 rounded-full shadow-lg transition transform hover:-translate-y-1 border border-white">
                            Registrarse
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Calendar Section -->
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-slate-100 h-fit">
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

                <div id='calendar' class="calendar-custom font-sans"></div>
            </div>

            <!-- Reservation Form Section -->
            <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-secondary-500 h-fit sticky top-24">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-secondary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Nueva Reserva
                </h3>

                <form action="<?php echo e(route('reservations.store')); ?>" method="POST" class="space-y-5">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Área Común</label>
                        <div class="relative">
                            <select name="area_id"
                                class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 appearance-none bg-white transition-shadow cursor-pointer">
                                <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($area->id); ?>"><?php echo e($area->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <input type="date" name="reservation_date"
                            class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 appearance-none bg-white transition-shadow text-gray-900 cursor-pointer"
                            required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1 border-r border-gray-100 pr-2">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Hora
                                Inicio</label>
                            <div class="relative">
                                <input type="text" name="time_start"
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

                        <div class="col-span-1 pl-2">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Hora Fin</label>
                            <div class="relative">
                                <input type="text" name="time_end"
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
                        <input type="number" name="attendees" min="1" value="1"
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
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Initialize Flatpickr
                flatpickr(".timepicker", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    altInput: true,
                    altFormat: "h:i K",
                    time_24hr: false, // UI shows AM/PM
                    locale: "es" // Spanish locale
                });

                const calendarEl = document.getElementById('calendar');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'es',
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
                        <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        {
                                title: '<?php echo e($reservation->area->name); ?>',
                                start: '<?php echo e($reservation->start_time); ?>',
                                end: '<?php echo e($reservation->end_time); ?>',
                                color: '<?php echo e($reservation->status == "confirmed" ? "#10b981" : ($reservation->status == "cancelled" ? "#ef4444" : "#f59e0b")); ?>', // Green for confirmed, Red for cancelled, Orange for pending
                                extendedProps: {
                                    user: '<?php echo e($reservation->user->name); ?>',
                                    status: '<?php echo e($reservation->status); ?>'
                                }
                            },
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    ],
                    eventDidMount: function (info) {
                        // Add tooltip or custom element if needed
                        info.el.title = info.event.extendedProps.user + ' (' + info.event.extendedProps.status + ')';
                    }
                });
                calendar.render();
            });
        </script>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\chuite\Documents\GitHub\torre_solento\resources\views/dashboard.blade.php ENDPATH**/ ?>