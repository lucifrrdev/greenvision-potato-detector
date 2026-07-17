<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DiseaseSolutionSeeder::class,
        ]);

        // Seed admin user
        User::firstOrCreate(
            ['email' => 'admin@greenvision.com'],
            [
                'name' => 'Administrator Greenvision',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}

