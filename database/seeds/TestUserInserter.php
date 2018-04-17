<?php

namespace database\seeds;

use Illuminate\Database\Seeder;

class TestUserInserter extends Seeder
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
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'role' => '1',
        ]);
    }
}
