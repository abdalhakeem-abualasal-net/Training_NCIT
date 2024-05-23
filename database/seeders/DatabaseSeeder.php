<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Abedalhakim Abu-Alasal',
            'email' => 'AbedalhakimAdmin@gmail.com',
            'isadmin' => true, // Assuming isadmin is a boolean field
            'password' => bcrypt('12345678') // Hash the password for security
        ]);
    }
}
