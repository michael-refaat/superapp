<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rates')->insert([

            ['country' => 'US',   'rate' => 2],
            ['country' => 'UK',   'rate' => 3],
            ['country' => 'CN',   'rate' => 2],

        ]);
    }
}
