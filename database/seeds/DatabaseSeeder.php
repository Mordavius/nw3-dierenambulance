<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->insert([
        'name' => str_random(10),
        'email' => str_random(10).'@gmail.com',
        'password' => bcrypt('secret'),
        'role' => '1',
        ]);
    }
}
