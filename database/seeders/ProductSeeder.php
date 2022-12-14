<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = array(
            [
                'category_id' => 2,
                'brand_id' => 1,
                'name' => 'Chatime Milk Tea',
                'price' => 15000,
                'stock' => 10,
            ], [
                'category_id' => 2,
                'brand_id' => 5,
                'name' => 'Starbucks Coffee',
                'price' => 20000,
                'stock' => 10,
            ], [
                'category_id' => 1,
                'brand_id' => 2,
                'name' => 'KFC Chicken',
                'price' => 25000,
                'stock' => 10,
            ], [
                'category_id' => 1,
                'brand_id' => 3,
                'name' => 'McDonalds Burger',
                'price' => 30000,
                'stock' => 10,
            ], [
                'category_id' => 1,
                'brand_id' => 4,
                'name' => 'Pizza Hut Pizza',
                'price' => 35000,
                'stock' => 10,
            ]
        );

        foreach ($datas as $val) {
            DB::table('products')->insert([
                'category_id' => $val['category_id'],
                'brand_id' => $val['brand_id'],
                'name' => $val['name'],
                'price' => $val['price'],
                'stock' => $val['stock'],
            ]);
        }
    }
}
