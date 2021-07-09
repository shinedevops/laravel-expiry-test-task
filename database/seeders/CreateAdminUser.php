<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Create roles **/
        $default_roles = ["admin","frontend"];
        foreach( $default_roles as $single_role ){
            Role::firstOrCreate([
                'name' => $single_role
            ]);
        }

        /** Create Admin **/
        $admin_user = User::whereHas("roles", function($q){ $q->where("name", "admin"); })->get();
        if( !$admin_user->count() ){
            $admin_user = User::create([
                'name'      =>  'admin',
                'email'     =>  'admin@mailinator.com',
                'password'  => bcrypt('main@admin')
            ]);
            $admin_user->assignRole('admin');
        }

        /** Create frontend users **/
        $user_emails = ['testing.user1@mailinator.com','testing.user2@mailinator.com'];
        foreach( $user_emails as $single_email ){
            $user = User::firstOrCreate([
                'email'     =>  $single_email
            ],[
                'name'      =>  'User',
                'password'  => bcrypt('12345678')
            ]);
            $user->assignRole('frontend');
        }
        
    }
}
