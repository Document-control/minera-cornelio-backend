<?php

namespace Database\Seeders;

use App\Models\ClientStatus;
use Illuminate\Database\Seeder;

class ClientStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientStatus::create(['name' => 'ANULADO']);
        ClientStatus::create(['name' => 'PENDIENTE']);
        ClientStatus::create(['name' => 'SEGUIMIENTO']);
        ClientStatus::create(['name' => 'VIGENTE']);
        ClientStatus::create(['name' => 'INACTIVO']);
    }
}
