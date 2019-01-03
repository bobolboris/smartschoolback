<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesLocalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_localities')->insert([
            ['name' => 'Город'],
            ['name' => 'Посёлок городского типа'],
            ['name' => 'Село']
        ]);
    }
}
