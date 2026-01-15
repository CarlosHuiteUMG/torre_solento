

<?php $__env->startSection('content'); ?>
<div class="bg-white p-4 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Mis reservas</h2>
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">Área</th>
                <th class="text-left">Inicio</th>
                <th class="text-left">Fin</th>
                <th class="text-left">Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b">
                    <td class="py-2"><?php echo e($reservation->area->name); ?></td>
                    <td><?php echo e($reservation->start_time); ?></td>
                    <td><?php echo e($reservation->end_time); ?></td>
                    <td><?php echo e(ucfirst($reservation->status)); ?></td>
                    <td>
                        <form method="POST" action="<?php echo e(route('reservations.destroy', $reservation)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="text-red-600">Cancelar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="py-4">No tienes reservas aún.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\chuite\Documents\GitHub\torre_solento\resources\views/user/reservations/index.blade.php ENDPATH**/ ?>