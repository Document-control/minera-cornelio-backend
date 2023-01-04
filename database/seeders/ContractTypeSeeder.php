<?php

namespace Database\Seeders;

use App\Models\ContractType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContractTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContractType::create([
            'description' => 'CONCESIÓN MINERA'
        ]);

        ContractType::create([
            'description' => 'ACOPIADOR REINFO'
        ]);
    }
}
