<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([[
            'name' => 'Super Admin',
            'username' => 'super_admin',
            'email' => 'super_admin@email-sample.com',
            'password' => bcrypt('P4$$w0Rd'),
            'email_verified_at' => now(),
            'remember_token' => str()->random(10)
        ]]);

        $users->each(fn($user) => User::create($user));
    }
}
