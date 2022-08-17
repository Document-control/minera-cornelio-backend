<?php

namespace Database\Seeders;

use App\Models\BusinessType;
use Illuminate\Database\Seeder;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Mineral en Grosa',
                'code' => 'Brz',
                'many_minerals' => true,
            ],
            [
                'name' => 'Concentrado de cliente',
                'code' => 'Cc',
                'many_minerals' => false,
                // TODO: considerar para 'has_valorization' => true,
            ],
            [
                'name' => 'Tratamiento de mineral',
                'code' => 'Tm',
                'many_minerals' => true
                // tarifa establecida por mineral
            ],
        ];
        foreach ($data as $key => $value) {
            BusinessType::created([
                'name' => $value['name'],
                'code' => $value['code'],
                'many_minerals' => $value['many_minerals'],
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
