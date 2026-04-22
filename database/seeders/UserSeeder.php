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
            'name' => 'OMMM',
            'email' => 'admin@mail.com',
            'password' => 'admin123',
            'role_id' => $admin->id,
        ]);

        User::create([
            'name' => 'Racoon',
            'email' => 'racoon@mail.com',
            'password' => 'racoon123',
            'role_id' => $user->id,
        ]);

        User::create([
            'name' => 'Emma',
            'email' => 'emma@mail.com',
            'password' => 'emma123',
            'role_id' => $user->id,
        ]);
    }
}
