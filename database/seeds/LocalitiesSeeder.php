<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('localities')->insert([
            ['name' => 'Донецк', 'type_id' => 1],
            ['name' => 'Докучаевск', 'type_id' => 1]
        ]);
    }
}
