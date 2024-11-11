<?php

namespace Database\Seeders;

use App\Models\Console\Field;
use App\Models\Console\File\Iki;
use App\Models\Console\Files\Akip;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IkiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::notSuperAdmin()->get();

        $users->each(function ($user) {
            Iki::create([
                'document_path' => 'docs/sample.pdf',
                'document_year' => 2024,
                'user_id' => $user->id,
            ]);
        });

        collect([
            [
                'title' => 'Dokumen Rencana Strategis / Rencana Strategis Bisnis (RSB)',
            ],
            [
                'title' => 'Lampiran Definisi Operasional Pada Renstra / RSB',
            ],
            [
                'title' => 'Pohon Kinerja BRIDA',
            ],
            [
                'title' => 'Perjanjian Kinerja',
            ],
            [
                'title' => 'Rencana Aksi Atas Perjanjian Kinerja',
            ],
            [
                'title' => 'Pedoman Penyusunan Rencana Strategis',
            ],
        ])->each(function ($doc) {
            Akip::create([
                'title' => strtoupper($doc['title']),
                'document_path' => 'docs/sample.pdf',
                'document_year' => 2024,
                'pic' => '-',
            ]);
        });
    }
}
