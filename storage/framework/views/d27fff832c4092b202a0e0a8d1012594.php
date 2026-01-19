

<?php $__env->startSection('content'); ?>
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Mis reservas</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-3 py-2 text-left font-medium text-gray-500 whitespace-nowrap">Área</th>
                        <th class="px-3 py-2 text-left font-medium text-gray-500 whitespace-nowrap">Inicio</th>
                        <th class="px-3 py-2 text-left font-medium text-gray-500 whitespace-nowrap">Fin</th>
                        <th class="px-3 py-2 text-left font-medium text-gray-500 whitespace-nowrap">Estado</th>
                        <th class="px-3 py-2"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 py-3 font-medium text-gray-900 whitespace-nowrap"><?php echo e($reservation->area->name); ?>

                                    </td>
                                    <td class="px-3 py-3 text-gray-600 whitespace-nowrap">
                                        <?php echo e(\Carbon\Carbon::parse($reservation->start_time)->format('d/m/Y H:i')); ?></td>
                                    <td class="px-3 py-3 text-gray-600 whitespace-nowrap">
                                        <?php echo e(\Carbon\Carbon::parse($reservation->end_time)->format('d/m/Y H:i')); ?></td>
                                    <td class="px-3 py-3 whitespace-nowrap">
                                        <?php
                                            $statusClasses = match ($reservation->status) {
                                                'confirmed' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                                'en_curso' => 'bg-blue-100 text-blue-800',
                                                'finalizada' => 'bg-gray-100 text-gray-800',
                                                default => 'bg-yellow-100 text-yellow-800', // Pending
                                            };
                                            
                                            $statusLabels = match ($reservation->status) {
                                                'confirmed' => 'Confirmada',
                                                'cancelled' => 'Cancelada',
                                                'en_curso' => 'En Curso',
                                                'finalizada' => 'Finalizada',
                                                default => 'Pendiente',
                                            };
                                        ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($statusClasses); ?>">
                                            <?php echo e($statusLabels); ?>

                                        </span>
                                    </td>
                                    <td class="px-3 py-3 text-right whitespace-nowrap">
                                        <?php if(in_array($reservation->status, ['pendiente', 'confirmed'])): ?>
                                            <form method="POST" action="<?php echo e(route('reservations.destroy', $reservation)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button
                                                    class="bg-white border border-red-300 text-red-600 hover:bg-red-50 hover:text-red-700 font-semibold py-1 px-3 rounded-md text-xs transition duration-150 ease-in-out shadow-sm">
                                                    Cancelar
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-3 py-4 text-center text-gray-500">No tienes reservas aún.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\chuite\Documents\GitHub\torre_solento\resources\views/user/reservations/index.blade.php ENDPATH**/ ?>