<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = array(
            'Chatime',
            'KFC',
            'McDonalds',
            'Pizza Hut',
            'Starbucks',
        );

        foreach ($datas as $val) {
            DB::table('brands')->insert([
                'name' => $val,
            ]);
        }
    }
}
