<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $admin = Role::where('name', Role::ADMIN)->first();
        $user = Role::where('name', Role::USER)->first();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => 'admin123',
            'role_id' => $admin->id,
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => 'user123',
            'role_id' => $user->id,
        ]);

        User::create([
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'test123',
            'role_id' => $user->id,
        ]);
    }
}
