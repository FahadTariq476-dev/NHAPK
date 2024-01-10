<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MembershipRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles=[
            [
                'name' => 'Who did not  decided  role yet',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'nhapk_register' => 1,
            ],
            [
                'name' => 'I am Hostelites',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ],
            [
                'name' => 'Hostel Working Staff eg. Made,  Helper, Doormen / Guard',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ],
            [
                'name' => 'Admin / Manager / Cook / Warden',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ],
            [
                'name' => 'Staff or Team Member of NHAP',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ],
            [
                'name' => 'Sponsor / Supporter of NHAP',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ],
            [
                'name' => 'Private Hostel Owner/ Antiusist',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ],
            [
                'name' => 'Area Leader Hostel Owner',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ],
            [
                'name' => 'Group Leader / Executive Member of City Union',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ],
            [
                'name' => 'Executive Member of NHAP + All City Coordinators',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ], 
            [
                'name' => 'Coordinator',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ], 
            [
                'name' => 'State Leaders & Senior Executive',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ], 
            [
                'name' => 'Federation Board Members',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ], 
            [
                'name' => 'CEO / Founder',
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), 
                'nhapk_register' => 1,
            ],
        ];
        Role::insert($roles);
    }
}
