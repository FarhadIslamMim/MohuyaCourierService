<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryChargeHeadTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('delivery_charge_heads')->delete();
        
        DB::table('delivery_charge_heads')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Inside City',
                'bangla_name' => 'শহরের ভিতরে',
                'slug' => 'inside-city',
                'service_time' => '24hrs',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Sub City',
                'bangla_name' => 'উপশহর',
                'slug' => 'sub-city',
                'service_time' => '48-72hrs',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Outside City',
                'bangla_name' => 'শহরের বাহিরে',
                'slug' => 'outside-city',
                'service_time' => 'within 5 days',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ));
        
        
    }
}