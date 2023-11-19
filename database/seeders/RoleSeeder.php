<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles=[
            [
                'name' => 'nhapk_admin',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
            ],
            [
                'name' => 'nhapk_client',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
            ],
        ];
        Role::insert($roles);

        // Create new admin user and assign role
        $admin = \App\Models\User::factory()->create([
            'name' => 'NHAPK_Admin',
            'email' => 'nhapk_admin@hostel.com',
            'password' => Hash::make("12345678")
        ]);
        $admin->assignRole("nhapk_admin");


        // Create new admin user and assign role
        $cleint = \App\Models\User::factory()->create([
            'name' => 'NHAPK_Client',
            'email' => 'nhapk_client@hostel.com',
            'password' => Hash::make("12345678")
        ]);
        $cleint->assignRole("nhapk_client");

    }
}
