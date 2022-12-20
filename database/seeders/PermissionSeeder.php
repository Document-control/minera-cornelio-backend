<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'dashboard',
                'slug' => 'dashboard'
            ],
            [
                'name' => 'productos',
                'slug' => 'products'
            ],
            [
                'name' => 'categorias',
                'slug' => 'categories'
            ],
            [
                'name' => 'perfil',
                'slug' => 'profile'
            ],
            [
                'name' => 'usuarios',
                'slug' => 'adm-users'
            ],
            [
                'name' => 'roles',
                'slug' => 'adm-roles'
            ],
            [
                'name' => 'permisos',
                'slug' => 'adm-permissions'
            ],
        ];

        foreach ($permissions as $key => $permision) {
            Permission::create([
                'name' => $permision['name'],
                'slug' => $permision['slug']
            ]);
        }
    }
}
