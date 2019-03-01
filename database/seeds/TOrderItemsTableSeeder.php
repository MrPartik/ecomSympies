<?php

use Illuminate\Database\Seeder;

class TOrderItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('t_order_items')->delete();

        \DB::table('t_order_items')->insert(array (
            0 =>
            array (
                'ORDI_ID' => 7,
                'ORD_ID' => 10,
                'PROD_ID' => 1,
                'PRODV_ID' => NULL,
                'ORDI_QTY' => 2,
                'ORDI_NOTE' => 'Sample Note',
                'ORDI_SOLD_PRICE' => 4724.0,
                'created_at' => '2019-02-26 16:07:46',
                'updated_at' => '2019-02-26 16:07:46',
            ),
            1 =>
            array (
                'ORDI_ID' => 9,
                'ORD_ID' => 12,
                'PROD_ID' => 1,
                'PRODV_ID' => NULL,
                'ORDI_QTY' => 1,
                'ORDI_NOTE' => 'Item note',
                'ORDI_SOLD_PRICE' => 2372.0,
                'created_at' => '2019-02-26 17:37:47',
                'updated_at' => '2019-02-26 17:37:47',
            ),
            2 =>
            array (
                'ORDI_ID' => 10,
                'ORD_ID' => 13,
                'PROD_ID' => 5,
                'PRODV_ID' => NULL,
                'ORDI_QTY' => 2,
                'ORDI_NOTE' => NULL,
                'ORDI_SOLD_PRICE' => 7860.0,
                'created_at' => '2019-02-26 17:39:37',
                'updated_at' => '2019-02-26 17:39:37',
            ),
        ));


    }
}
