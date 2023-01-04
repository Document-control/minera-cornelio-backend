<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(2)->create();
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(MineralSeeder::class);
        $this->call(KindPersonSeeder::class);
        // $this->call(OperationTypeSeeder::class);
        $this->call(BusinessTypeSeeder::class);
        $this->call(ClientStatusSeeder::class);
        $this->call(ContractStatusSeeder::class);
        $this->call(ContractTypeSeeder::class);
        $this->call(DocumentSeeder::class);

        // para los departamentos,
        $path = base_path() . '/ubigeo2016.sql';
        $sql = file_get_contents($path);
        DB::unprepared($sql);

        $users = User::all();
        $roles = Role::all();

        foreach ($roles as $key => $role) {
            $role->permissions()->attach(Permission::all()->pluck('id'));
        }

        foreach ($users as $key => $user) {
            $user->roles()->attach(Role::all()->pluck('id'));
            $user->permissions()->attach(Permission::all()->pluck('id'));
        }
    }
}
