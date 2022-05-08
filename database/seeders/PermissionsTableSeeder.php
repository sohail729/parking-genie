<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions = [
            //   [
            //       'name' => 'create-user',
                  
            //   ],
            //   [
            //       'name' => 'read-user',
                  
            //   ],
            //   [
            //       'name' => 'update-user',
                  
            //   ],
            //   [
            //       'name' => 'delete-user',
                  
            //   ],
            //   [
            //       'name' => 'create-role',
                  
            //   ],
            //   [
            //       'name' => 'read-role',
                  
            //   ],
            //   [
            //       'name' => 'update-role',
                  
            //   ],
            //   [
            //       'name' => 'delete-role',
                  
            //   ],
            //   [
            //       'name' => 'create-project',
                  
            //   ],
            //   [
            //       'name' => 'read-project',
                  
            //   ],
            //   [
            //       'name' => 'update-project',
                  
            //   ],
            //   [
            //       'name' => 'delete-project',
                  
            //   ],
            //   [
            //       'name' => 'create-technology',
                  
            //   ],
            //   [
            //       'name' => 'read-technology',
                  
            //   ],
            //   [
            //       'name' => 'update-technology',
                  
            //   ],
            //   [
            //       'name' => 'delete-technology',
                  
            //   ],
              [
                  'name' => 'update-credentials',
                  
              ],
              [
                  'name' => 'access-credentials',
                  
              ]
          ];
          foreach($permissions as $permission) {
            Permission::create($permission);
        }
        $role = Role::findById(1);
        $role->givePermissionTo($permissions);
    }
}
