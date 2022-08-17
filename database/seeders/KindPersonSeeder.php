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
            'OWNER',
            'CONTACT',
            'REPRE LEGAL',
            'MANAGER',
        ];

        foreach ($data as $key => $value) {
            KindPerson::created([
                'name' => $value,
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
