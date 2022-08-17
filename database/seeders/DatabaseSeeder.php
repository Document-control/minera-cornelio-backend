<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
    }
}
