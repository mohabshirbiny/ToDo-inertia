<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        if (!User::where('email','admin@test.com')->first()) {
         
            User::factory()->create([
                'name'      => 'Admin User',
                'email'     => 'admin@test.com',
                'password'  => Hash::make('password'),
                'admin'     => true,
            ]);
        }

        User::factory(10)->create();

    }
}
