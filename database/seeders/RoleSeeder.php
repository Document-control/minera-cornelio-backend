<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);

        Role::create([
            'name' => 'Accionista',
            'slug' => 'owner',
            // clientes, contratos
        ]);

        Role::create([
            'name' => 'Supervisor comercial',
            'slug' => 'sup-commercial',
        ]);

        Role::create([
            'name' => 'Colaborador comercial',
            'slug' => 'commercial',
        ]);

        Role::create([
            'name' => 'Supervisor legar',
            'slug' => 'sup-legal',
        ]);

        Role::create([
            'name' => 'Colaborador legar',
            'slug' => 'legal',
        ]);
    }
}
