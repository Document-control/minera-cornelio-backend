<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Vigencia de Poder', 'DNI', 'Ficha Ruc'];

        foreach ($data as $key => $value) {
            Document::create([
                'name' => $value,
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
