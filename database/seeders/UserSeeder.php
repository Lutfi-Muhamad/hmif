<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        // User 1: Super Admin
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@if.untirta.ac.id',
            'password' => Hash::make('password'),
        ]);
        $superadmin->syncRoles('superadmin');
        // User 2: Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin2@if.untirta.ac.id',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');
        
        // User 3: Regular User 1 (Anggota HMIF)
        $user1 = User::create([
            'name' => 'Regular User 1',
            'email' => 'user1@if.untirta.ac.id',
            'password' => Hash::make('password'),
        ]);
        $user1->assignRole('hmif');
        
        // User 4: Regular User 2 (Anggota HMIF)
        $user2 = User::create([
            'name' => 'Regular User 2',
            'email' => 'user2@if.untirta.ac.id',
            'password' => Hash::make('password'),
        ]);
        $user2->assignRole('hmif');
        // User 5: Regular User 3 (Mahasiswa IF)
        $user3 = User::create([
            'name' => 'Regular User 3',
            'email' => 'user3@if.untirta.ac.id',
            'password' => Hash::make('password')
        ]);
        $user3->assignRole('user');
    }
}
