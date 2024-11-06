<?php

namespace Database\Seeders;

use App\Models\Console\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name' => 'Sekretariat',
            ],
            [
                'name' => 'Bidang Pemanfaatan, Fasilitasi Riset dan Inovasi Daerah',
            ],
            [
                'name' => 'Bidang Riset dan Teknologi Daerah',
            ],
            [
                'name' => 'Bidan SDM dan Infrastruktur Riset Daerah',
            ],
            [
                'name' => 'Bidang Kebijakan Pembangunan Riset Daerah',
            ],
        ])->each(fn($field) => Field::create($field));
    }
}
