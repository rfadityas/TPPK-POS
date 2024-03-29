<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = array(
            'Makanan',
            'Minuman',
        );

        foreach ($datas as $val) {
            DB::table('categories')->insert([
                'name' => $val,
            ]);
        }
    }
}
