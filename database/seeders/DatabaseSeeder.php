<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'nome' => 'Edu Poch',
            'email' => 'edupoch@gmail.com',
            'dni' => '12345678A',
            'rol' => 'admin',
            'num_socia' => 1,
            'password' => Hash::make('12345'),
        ]);

        \App\Models\User::factory(100)->create();
    }
}
