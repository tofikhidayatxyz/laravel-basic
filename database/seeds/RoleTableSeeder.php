<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'description' => 'Role for admin'
        ]);

        Role::create([
            'name' => 'teacher',
            'description' => 'Role for teacher'
        ]);

        Role::create([
            'name' => 'user',
            'description' => 'Role for user'
        ]);
    }
}
