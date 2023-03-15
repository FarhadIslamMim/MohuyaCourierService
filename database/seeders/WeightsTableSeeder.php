<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('weights')->delete();

        DB::table('weights')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Upto 500g',
                'bangla_name' => '৫০০ গ্রাম পর্যন্ত',
                'value' => 0.5,
                'extra_weight' => 0.0,
                'status' => 1,
                'created_at' => '2022-05-10 12:16:44',
                'updated_at' => '2022-05-10 12:16:44',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Upto 1kg',
                'bangla_name' => '১ কেজি পর্যন্ত',
                'value' => 1.0,
                'extra_weight' => 1.0,
                'status' => 1,
                'created_at' => '2022-05-10 12:16:44',
                'updated_at' => '2022-05-10 12:16:44',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'Upto 2kg',
                'bangla_name' => '২ কেজি পর্যন্ত',
                'value' => 2.0,
                'extra_weight' => 2.0,
                'status' => 1,
                'created_at' => '2022-05-10 12:16:44',
                'updated_at' => '2022-05-10 12:16:44',
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'Upto 3kg',
                'bangla_name' => '৩ কেজি পর্যন্ত',
                'value' => 3.0,
                'extra_weight' => 3.0,
                'status' => 1,
                'created_at' => '2022-05-10 12:16:44',
                'updated_at' => '2022-05-10 12:16:44',
            ),
            4 =>
            array(
                'id' => 5,
                'name' => 'Upto 4kg',
                'bangla_name' => '৪ কেজি পর্যন্ত',
                'value' => 4.0,
                'extra_weight' => 4.0,
                'status' => 1,
                'created_at' => '2022-05-10 12:16:44',
                'updated_at' => '2022-05-10 12:16:44',
            ),
            5 =>
            array(
                'id' => 6,
                'name' => 'Upto 5kg',
                'bangla_name' => '৫ কেজি পর্যন্ত',
                'value' => 5.0,
                'extra_weight' => 5.0,
                'status' => 1,
                'created_at' => '2022-05-10 12:16:44',
                'updated_at' => '2022-05-10 12:16:44',
            ),
            7 =>
            array(
                'id' => 7,
                'name' => 'Upto 6 KG',
                'bangla_name' => '৬ কেজি পর্যন্ত',
                'value' => 6.0,
                'extra_weight' => 6.0,
                'status' => 1,
                'created_at' => '2022-12-28 07:02:22',
                'updated_at' => '2022-12-28 07:02:25',
            ),
            8 =>
            array(
                'id' => 8,
                'name' => 'Upto 7 KG',
                'bangla_name' => '৭ কেজি পর্যন্ত',
                'value' => 7.0,
                'extra_weight' => 7.0,
                'status' => 1,
                'created_at' => '2022-12-28 07:06:26',
                'updated_at' => '2022-12-28 07:06:31',
            ),
            9 =>
            array(
                'id' => 9,
                'name' => 'Upto 8 KG',
                'bangla_name' => '৮ কেজি পর্যন্ত',
                'value' => 8.0,
                'extra_weight' => 8.0,
                'status' => 1,
                'created_at' => '2022-12-28 07:06:35',
                'updated_at' => '2022-12-28 07:06:38',
            ),
            10 =>
            array(
                'id' => 10,
                'name' => 'Upto 9 KG',
                'bangla_name' => '৯ কেজি পর্যন্ত',
                'value' => 9.0,
                'extra_weight' => 9.0,
                'status' => 1,
                'created_at' => '2022-12-28 07:06:40',
                'updated_at' => '2022-12-28 07:06:43',
            ),
            11 =>
            array(
                'id' => 11,
                'name' => 'Upto 10 KG',
                'bangla_name' => '১০ কেজি পর্যন্ত',
                'value' => 10.0,
                'extra_weight' => 10.0,
                'status' => 1,
                'created_at' => '2022-12-28 07:06:45',
                'updated_at' => '2022-12-28 07:06:48',
            ),
        ));
    }
}
