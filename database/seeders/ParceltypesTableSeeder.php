<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParceltypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('parceltypes')->delete();
        
        DB::table('parceltypes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Pending',
                'slug' => 'pending',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Picked',
                'slug' => 'picked',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'In Transit',
                'slug' => 'in-transit',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Delivered',
                'slug' => 'deliverd',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Hold',
                'slug' => 'hold',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'Return Pending',
                'slug' => 'return-pending',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'Return To Hub',
                'slug' => 'return-to-hub',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'title' => 'Return To Merchant',
                'slug' => 'return-to-merchant',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'title' => 'Cancelled',
                'slug' => 'cancelled',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'title' => 'Out for delivery',
                'slug' => 'out-for-delivery',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}