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
        ClientStatus::create(['name' => 'ACTIVO']);   // CON CONTRATO
        ClientStatus::create(['name' => 'INACTIVO']); // SIN CONTRATO, CONTRATO VENCIDO

        // TODO: HACER UN JOB Para cambiar el estado del cliente segun la fecha de vencimiento del contrato
    }
}
