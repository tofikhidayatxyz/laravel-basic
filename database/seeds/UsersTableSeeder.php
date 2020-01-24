<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin =  Role::where('name', 'admin')->first();
        $roleteacher =  Role::where('name', 'teacher')->first();
        $roleUser = Role::where('name', 'user')->first();


        $admin =  User::create([
            'name' => 'Admin',
            'email' => 'admin@test.app',
            'address' => 'Sukabumi jawabarat',
            'born' => '2002-02-02',
            'hobby' => 'main catur',
            'phone' => '08989647650337',
            'password'=> bcrypt('secret')
        ]);
        $admin->roles()->attach($roleAdmin);

        $teacher =  User::create([
            'name' => 'Teacher',
            'email' => 'teacher@test.app',
            'address' => 'Sukabumi jawabarat',
            'born' => '2002-02-02',
            'hobby' => 'main catur',
            'phone' => '08989647650337',
            'password'=> bcrypt('secret')
        ]);
        $teacher->roles()->attach($roleteacher);

        $user =  User::create([
            'name' => 'User',
            'email' => 'user@test.app',
            'address' => 'Sukabumi jawabarat',
            'born' => '2002-02-02',
            'hobby' => 'main catur',
            'phone' => '08989647650337',
            'password'=> bcrypt('secret')
        ]);
        $user->roles()->attach($roleUser);



    }
}
