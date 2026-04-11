<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Association1',
            'email' => 'association1@gmail.com',
            'password' => Hash::make('association1'),
            'role' => 'association',
            'status' => 'ACTIVE',
            'ville' => 'Safi',
            'licenseNumber' => 'ASSOC-2026-001',
            'description' => 'Une association dédiée à l\'amélioration des conditions de vie. Nous travaillons sur plusieurs initiatives de santé et d\'éducation pour les plus démunis.',
            'category_id' => 1,
        ]);

        User::create([
            'name' => 'donateur1',
            'email' => 'donateur1@gmail.com',
            'password' => Hash::make('donateur1'),
            'role' => 'donator',
        ]);
    }
}
