<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(2)->create();
        $this->call(MineralSeeder::class);
        $this->call(KindPersonSeeder::class);
        $this->call(OperationTypeSeeder::class);
        $this->call(BusinessTypeSeeder::class);

        // para los departamentos,
        $path = base_path() . '/ubigeo2016.sql';
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
