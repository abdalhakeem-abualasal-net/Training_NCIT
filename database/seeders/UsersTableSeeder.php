<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Abu Alasal',
            'email' => 'Abedalhakim@example.com',
            'password' => Hash::make('12345678'),
            'isadmin' => true,
        ]);

    }
}
