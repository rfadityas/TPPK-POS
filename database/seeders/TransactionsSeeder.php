<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = array([
            'user_id' => 1,
            'total_price' => 35000,
        ], [
            'user_id' => 1,
            'total_price' => 55000,
        ], [
            'user_id' => 1,
            'total_price' => 70000,
        ]);

        foreach ($datas as $val) {
            DB::table('transactions')->insert([
                'user_id' => $val['user_id'],
                'total_price' => $val['total_price'],
            ]);
        }
    }
}
