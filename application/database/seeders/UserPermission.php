<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class UserPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crud = [
            'view', 'add', 'edit','delete'
        ];

        $cruds = array_merge($crud, ['status']);

        $permissionsList = [
            'project_vertical' => array(
                'view'=>array(
                    'description' => 'View',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
				'delete'=>array(
                    'description' => 'delete',
                ),
                'status'=>array(
                    'description' => 'status change',
                ),
            ),
			'project_category' => array(
                'view'=>array(
                    'description' => 'View',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
				'delete'=>array(
                    'description' => 'delete',
                ),
                'status'=>array(
                    'description' => 'status change',
                ),
            ),
			'project_sub_category' => array(
                'view'=>array(
                    'description' => 'View',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
				'delete'=>array(
                    'description' => 'delete',
                ),
                'status'=>array(
                    'description' => 'status change',
                ),
            ),
			'project_mini_category' => array(
                'view'=>array(
                    'description' => 'View',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
				'delete'=>array(
                    'description' => 'delete',
                ),
                'status'=>array(
                    'description' => 'status change',
                ),
            ),
			'project_forms' => array(
                'view'=>array(
                    'description' => 'View',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
				'delete'=>array(
                    'description' => 'delete',
                ),
                'status'=>array(
                    'description' => 'status change',
                ),
            ),
			'project_leads' => array(
                'view'=>array(
                    'description' => 'View',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
				'delete'=>array(
                    'description' => 'delete',
                ),
                'status'=>array(
                    'description' => 'status change',
                ),
            ),
            'role' => array(
                'view'=>array(
                    'description' => 'View',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
				'delete'=>array(
                    'description' => 'delete',
                ),
                'status'=>array(
                    'description' => 'status change',
                ),
            ),
            
            'user_management' => array(
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
				'delete'=>array(
                    'description' => 'delete',
                ),
                'view'=>array(
                    'description' => 'User Listing View ',
                ),
                'status'=>array(
                    'description' => 'status change',
                ),
                
            ),
            
       
            
            
           
        ];

        // $this->dumpToJson($permissionsList);

        /** Clear the table */
        DB::table('permissions')->truncate();

        /** Seed the data */
        foreach ($permissionsList as $group => $permissions) {
            if (is_array($permissions)) {
                foreach ($permissions as $permission=>$per) {

                    DB::table('permissions')->insert([
                        'alias' => $group . '_' . $permission,
                        'name' => ucwords(str_replace('_', ' ', $permission)),
                        'description' => ucwords($per['description']),
                        'group' => $group,
                        'created_by' => 0,
                        'updated_by' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
