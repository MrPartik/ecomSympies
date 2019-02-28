<?php

use Illuminate\Database\Seeder;

class TOrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('t_orders')->delete();
        
        \DB::table('t_orders')->insert(array (
            0 => 
            array (
                'ORD_ID' => 10,
                'SYMPIES_ID' => 3,
                'ORD_SYMP_TRANS_CODE' => 'TRANSACT-5c756452bec49',
                'ORD_PAY_CODE' => 'PAYID-LR2V6YQ80B32453YA940542W',
                'ORD_TRANS_CODE' => '3UD59089U58880420',
                'ORD_FROM_NAME' => 'test buyer',
                'ORD_TO_NAME' => 'test buyer',
                'ORD_FROM_EMAIL' => 'loyolapat04@gmail.com',
                'ORD_TO_EMAIL' => 'loyolapat04-receiver@gmail.com',
                'ORD_FROM_CONTACT' => '0930975810',
                'ORD_TO_CONTACT' => '09309758130',
                'ORD_TO_ADDRESS' => '1 Main St, San Jose, CA, 95131, US',
                'ORD_FUNDING' => 'paypal',
                'ORD_DISCOUNT' => 0.0,
                'ORD_STATUS' => 'completed',
                'ORD_COMPLETE' => NULL,
                'ORD_CANCELLED' => NULL,
                'ORD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-26 16:07:46',
                'updated_at' => '2019-02-26 16:07:46',
            ),
            1 => 
            array (
                'ORD_ID' => 12,
                'SYMPIES_ID' => 3,
                'ORD_SYMP_TRANS_CODE' => 'TRANSACT-5c75796b032ed',
                'ORD_PAY_CODE' => 'PAYID-LR2XSMI9MV63889PW0743335',
                'ORD_TRANS_CODE' => '55K385062E569073X',
                'ORD_FROM_NAME' => 'test buyer',
                'ORD_TO_NAME' => 'test buyer',
                'ORD_FROM_EMAIL' => 'loyolapat04@gmail.com',
                'ORD_TO_EMAIL' => 'loyolapat04-receiver@gmail.com',
                'ORD_FROM_CONTACT' => '0930975810',
                'ORD_TO_CONTACT' => '09309758130',
                'ORD_TO_ADDRESS' => '1 Main St, San Jose, CA, 95131, US',
                'ORD_FUNDING' => 'paypal',
                'ORD_DISCOUNT' => 0.0,
                'ORD_STATUS' => 'pending',
                'ORD_COMPLETE' => NULL,
                'ORD_CANCELLED' => NULL,
                'ORD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-26 17:37:47',
                'updated_at' => '2019-02-26 17:37:47',
            ),
            2 => 
            array (
                'ORD_ID' => 13,
                'SYMPIES_ID' => 3,
                'ORD_SYMP_TRANS_CODE' => 'TRANSACT-5c7579d964645',
                'ORD_PAY_CODE' => 'PAYID-LR2XTLI57H54523PK008550L',
                'ORD_TRANS_CODE' => '4XN012416T179471L',
                'ORD_FROM_NAME' => 'test buyer',
                'ORD_TO_NAME' => 'test buyer',
                'ORD_FROM_EMAIL' => 'loyolapat04@gmail.com',
                'ORD_TO_EMAIL' => 'loyolapat04-receiver@gmail.com',
                'ORD_FROM_CONTACT' => '0930975810',
                'ORD_TO_CONTACT' => '09309758130',
                'ORD_TO_ADDRESS' => '1 Main St, San Jose, CA, 95131, US',
                'ORD_FUNDING' => 'paypal',
                'ORD_DISCOUNT' => 0.0,
                'ORD_STATUS' => 'pending',
                'ORD_COMPLETE' => NULL,
                'ORD_CANCELLED' => NULL,
                'ORD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-26 17:39:37',
                'updated_at' => '2019-02-26 17:39:37',
            ),
        ));
        
        
    }
}