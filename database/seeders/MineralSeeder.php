<?php

namespace Database\Seeders;

use App\Models\Mineral;
use Illuminate\Database\Seeder;

class MineralSeeder extends Seeder
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
                'name' => 'Plata',
                'chemical_element' => 'Ag',
            ],
            [
                'name' => 'Cobre',
                'chemical_element' => 'Cu',
            ],
            [
                'name' => 'Zing',
                'chemical_element' => 'Zn',
            ],
            [
                'name' => 'Plomo',
                'chemical_element' => 'Ag',
            ],
            [
                'name' => 'Oro',
                'chemical_element' => 'Au',
            ],
        ];


        foreach ($data as $key => $value) {
            Mineral::created([
                'name' => $value['name'],
                'chemical_element' => $value['chemical_element'],
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
