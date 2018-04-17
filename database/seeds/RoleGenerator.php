<?php

namespace database\seeds;

use Illuminate\Database\Seeder;

class RoleGenerator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        ['id' => 1, 'name' => "admin"],
        ['id' => 2, 'name' => "centrale"],
        ['id' => 3, 'name' => "ambulance"],
        ]);
    }
}
