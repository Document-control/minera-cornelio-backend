<?php

namespace Database\Seeders;

use App\Models\OperationType;
use Illuminate\Database\Seeder;

class OperationTypeSeeder extends Seeder
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
                'name' => 'Concessión minera convencional'
            ],
            [
                'name' => 'Proceso de formalización'
            ],
        ];

        foreach ($data as $key => $value) {
            OperationType::created([
                'name' => $value['name'],
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
