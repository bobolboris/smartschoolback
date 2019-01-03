<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schools')->insert([
            ['name' => '№1', 'locality_id' => 1],
            ['name' => '№2', 'locality_id' => 1],
            ['name' => '№3', 'locality_id' => 1],
            ['name' => '№4', 'locality_id' => 1],
            ['name' => '№5', 'locality_id' => 1],

            ['name' => '№1', 'locality_id' => 2],
            ['name' => '№2', 'locality_id' => 2],
            ['name' => '№3', 'locality_id' => 2],
            ['name' => '№4', 'locality_id' => 2],
            ['name' => '№5', 'locality_id' => 2]
        ]);
    }
}
