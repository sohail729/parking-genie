<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'type' => 'super',
                'fname' => 'Super',
                'lname' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => 'admin0101',
                'status' => 1
            ],
            [
                'type' => 'host',
                'fname' => 'Alex',
                'lname' => 'Host',
                'email' => 'host@admin.com',
                'stripe_connect_id' => 'acct_1KlBs22XdfKZ8pnJ',
                'password' => 'admin0101',
                'status' => 1
            ],
            [
                'type' => 'user',
                'fname' => 'John',
                'lname' => 'User',
                'email' => 'user@admin.com',
                'password' => 'admin0101',
                'status' => 1
            ]
        ];

        foreach($users as $user) {
          $new_user =  User::create($user);
          if($new_user['type'] == 'super'){
                $new_user->assignRole('super');
          }
          if($new_user['type'] == 'admin'){
                $new_user->assignRole('admin');
          }
          if($new_user['type'] == 'host'){
                $new_user->assignRole('host');
          }
          if($new_user['type'] == 'user'){
                $new_user->assignRole('user');
          }
        }
    }
}
