<?php

namespace Database\Seeders;

use App\Models\Console\Field;
use App\Models\Console\File\Iki;
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
    }
}
