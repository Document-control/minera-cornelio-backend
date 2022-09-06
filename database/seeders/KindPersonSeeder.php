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
                'name' => 'OWNER',
                'spanish_name' => 'DUEÑO',
            ],
            [
                'name' => 'LEGAL REPRESENTATIVE',
                'spanish_name' => 'REPRESENTANTE LEGAL',
            ],
            [
                'name' => 'DIRECT CONTACT',
                'spanish_name' => 'CONTACTO DIRECTO',
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
