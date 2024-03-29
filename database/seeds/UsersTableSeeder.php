<?php

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
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'superuser@gmail.com',
            'password' => bcrypt('secret'),
            'role_id' => '1',
        ]);
    }
}
