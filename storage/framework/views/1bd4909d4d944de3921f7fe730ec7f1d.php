

<?php $__env->startSection('content'); ?>
    <div class="min-h-[calc(100vh-16rem)] flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border border-slate-100 relative overflow-hidden">
            <!-- Decorative top bar -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary-800 to-primary-600"></div>

            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold text-gray-800">Bienvenido</h2>
                <p class="text-gray-500 mt-2 text-sm">Ingresa tus credenciales para acceder</p>
            </div>

            <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Correo Electrónico</label>
                    <div class="relative">
                        <input type="email" name="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors shadow-sm placeholder-gray-400"
                            placeholder="tu@correo.com" required />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Contraseña</label>
                    <div class="relative">
                        <input type="password" name="password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors shadow-sm placeholder-gray-400"
                            placeholder="••••••••" required />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="remember"
                            class="ml-2 block text-sm text-gray-600 cursor-pointer select-none">Recordarme</label>
                    </div>
                    <a href="#" class="text-sm font-medium text-primary-600 hover:text-primary-500">¿Olvidaste tu
                        contraseña?</a>
                </div>

                <button
                    class="w-full bg-primary-800 hover:bg-primary-900 text-white font-bold py-3 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Ingresar
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">
                ¿No tienes cuenta? <a href="<?php echo e(route('register')); ?>"
                    class="font-medium text-secondary-600 hover:text-secondary-500">Regístrate aquí</a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\chuite\Documents\GitHub\torre_solento\resources\views/auth/login.blade.php ENDPATH**/ ?>