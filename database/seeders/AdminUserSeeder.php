<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/AdminUserSeeder.php
public function run(): void
{
    User::create([
        'name'     => 'CrochetCraft Admin',
        'email'    => 'admin@crochetcraft.com',
        'password' => bcrypt('PASSWORD'),
        'role'     => 'admin',
    ]);
}
}
