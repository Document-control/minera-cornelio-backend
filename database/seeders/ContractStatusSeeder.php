<?php

namespace Database\Seeders;

use App\Models\ContractStatus;
use Illuminate\Database\Seeder;

class ContractStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContractStatus::create(['name' => 'ANULADO']);
        ContractStatus::create(['name' => 'PENDIENTE']); // BORRADOR
        ContractStatus::create(['name' => 'OBSERVADO']);
        ContractStatus::create(['name' => 'APROBADO']);
        ContractStatus::create(['name' => 'VIGENTE']);
    }
}
