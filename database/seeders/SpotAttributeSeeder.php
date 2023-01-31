<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpotAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('spot_attributes')->insert([
            ['name' => 'electric'],
            ['name' => 'for_women'],
            ['name' => 'with_kids'],
            ['name' => 'handicapped']
        ]);
    }
}
