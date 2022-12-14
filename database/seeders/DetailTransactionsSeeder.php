<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = array([
            'transaction_id' => 1,
            'product_id' => 1,
            'quantity' => 1,
            'price' => 15000,
        ], [
            'transaction_id' => 1,
            'product_id' => 2,
            'quantity' => 1,
            'price' => 20000,
        ], [
            'transaction_id' => 2,
            'product_id' => 3,
            'quantity' => 1,
            'price' => 25000,
        ], [
            'transaction_id' => 2,
            'product_id' => 4,
            'quantity' => 1,
            'price' => 30000,
        ], [
            'transaction_id' => 3,
            'product_id' => 5,
            'quantity' => 1,
            'price' => 35000,
        ]);

        foreach ($datas as $val) {
            DB::table('detail_transactions')->insert([
                'transaction_id' => $val['transaction_id'],
                'product_id' => $val['product_id'],
                'quantity' => $val['quantity'],
                'price' => $val['price'],
            ]);
        }
    }
}
