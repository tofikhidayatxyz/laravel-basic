<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Tofik Hidayat',
            'email' => 'tofik@sqira.co',
            'address' => 'Sukabumi jawabarat',
            'born' => '2002-02-02',
            'hobby' => 'main catur',
            'phone' => '08989647650337',
            'password'=> bcrypt('secret')
        ]);
    }
}
