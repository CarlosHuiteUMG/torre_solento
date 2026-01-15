

<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-slate-100">
            <div class="flex items-center justify-between mb-8 border-b border-gray-100 pb-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Mi Perfil</h2>
                    <p class="text-gray-500 text-sm mt-1">Administra tu información personal y de residencia</p>
                </div>
                <div class="h-12 w-12 bg-primary-100 rounded-full flex items-center justify-center text-primary-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>

            <form method="POST" action="<?php echo e(route('profile.update')); ?>" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Section Header -->
                <div class="md:col-span-2">
                    <h3
                        class="text-sm font-semibold text-primary-800 uppercase tracking-wider mb-4 bg-primary-50 p-2 rounded">
                        Datos Personales</h3>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre completo</label>
                    <input type="text" name="full_name" value="<?php echo e(old('full_name', $profile->full_name)); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 transition-shadow">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">DPI</label>
                    <input type="text" name="dpi" value="<?php echo e(old('dpi', $profile->dpi)); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 transition-shadow">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone', $profile->phone)); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 transition-shadow">
                </div>

                <!-- Section Header -->
                <div class="md:col-span-2 mt-4">
                    <h3
                        class="text-sm font-semibold text-primary-800 uppercase tracking-wider mb-4 bg-primary-50 p-2 rounded">
                        Datos de Residencia</h3>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Número de apartamento</label>
                    <input type="text" name="apartment_number"
                        value="<?php echo e(old('apartment_number', $profile->apartment_number)); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 transition-shadow">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nivel o piso</label>
                    <input type="text" name="floor" value="<?php echo e(old('floor', $profile->floor)); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 transition-shadow">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tipo de residente</label>
                    <div class="relative">
                        <select name="resident_type"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 transition-shadow appearance-none bg-white">
                            <option value="propietario" <?php if($profile->resident_type === 'propietario'): echo 'selected'; endif; ?>>Propietario
                            </option>
                            <option value="inquilino" <?php if($profile->resident_type === 'inquilino'): echo 'selected'; endif; ?>>Inquilino</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 mt-6 flex justify-end">
                    <button
                        class="bg-primary-800 hover:bg-primary-900 text-white font-bold px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\chuite\Documents\GitHub\torre_solento\resources\views/user/profile.blade.php ENDPATH**/ ?>