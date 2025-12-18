<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Default roles
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'residente']);

        // Default admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@torresolento.test'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');

        // Areas
        $areas = [
            ['name' => 'Salón Social I', 'description' => 'Salón principal para eventos'],
            ['name' => 'Salón Social II', 'description' => 'Salón alterno para reuniones'],
            ['name' => 'Área de churrasquera', 'description' => 'Parrillas y mesas al aire libre'],
            ['name' => 'Gimnasio', 'description' => 'Capacidad máxima 5 personas por horario', 'max_capacity' => 5],
        ];

        foreach ($areas as $area) {
            Area::firstOrCreate(['name' => $area['name']], $area);
        }
    }
}
