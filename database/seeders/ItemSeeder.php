<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([

            ['type' => 'T-shirt',     'price' => 30.99,   'country' => 'US',   'weight' => 0.2],
            ['type' => 'Blouse',      'price' => 10.99,   'country' => 'UK',   'weight' => 0.3],
            ['type' => 'Pants',       'price' => 64.99,   'country' => 'UK',   'weight' => 0.9],
            ['type' => 'Sweatpants',  'price' => 84.99,   'country' => 'CN',   'weight' => 1.1],
            ['type' => 'Jacket',      'price' => 199.99,  'country' => 'US',   'weight' => 2.2],
            ['type' => 'Shoes',       'price' => 79.99,   'country' => 'CN',   'weight' => 1.3],

        ]);
    }
}