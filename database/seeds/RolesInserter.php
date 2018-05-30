<?php

use Illuminate\Database\Seeder;

class RolesInserter extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Administrator'],
            ['id' => 2, 'name' => 'Centralist'],
            ['id' => 3, 'name' => 'Ambulance Medewerker'],
            ['id' => 4, 'name' => 'Administratie Medewerker'],
        ]);
    }
}
