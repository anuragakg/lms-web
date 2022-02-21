<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_roles')->truncate();

        $availableRoles = [
            [
                'title' => 'Super Administrator',
                'slug' => 'super_admin',
                'role_type' => 0
            ],
            [
                'title' => 'L1',
                'slug' => 'l1',
                'role_type' => 1
            ],
            [
                'title' => 'L2',
                'slug' => 'l2',
                'role_type' => 1
            ],
            [
                'title' => 'L3',
                'slug' => 'l3',
                'role_type' => 1
            ],
          
            
            
        ];

        foreach ($availableRoles as $key => $role) {
            DB::table('user_roles')->insert([
                'title' => $role['title'],
                'slug' => $role['slug'],
                'description' => '',
                'role_type' => (string) $role['role_type'],
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
