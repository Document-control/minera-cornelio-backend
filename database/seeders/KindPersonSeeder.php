<?php

namespace Database\Seeders;

use App\Models\KindPerson;
use Illuminate\Database\Seeder;

class KindPersonSeeder extends Seeder
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
                'name' => 'owner',
                'spanish_name' => 'dueño',
            ],
            [
                'name' => 'legal representative',
                'spanish_name' => 'representante legal',
            ],
            [
                'name' => 'direct contact',
                'spanish_name' => 'contacto directo',
            ],
        ];

        foreach ($data as $key => $value) {
            KindPerson::create([
                'name' => $value['name'],
                'spanish_name' => $value['spanish_name'],
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
