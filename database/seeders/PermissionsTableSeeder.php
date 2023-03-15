<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('permissions')->delete();
        
        DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'dashboard',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'website',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'setting',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'logo',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'logo_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'logo_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'logo_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'slider',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'slider_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'slider_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'slogan',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'feature',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'feature_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'feature_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'feature_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'hub_area',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'hub_area_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'hub_area_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'hub_area_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'service',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'service_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'service_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'service_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'create_page',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'create_page_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'create_page_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'create_page_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'panel_user',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'user_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'user_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'user_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'bulk_sms',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'send_sms',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'sms_balance',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'merchant',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'merchant_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'merchant_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'merchant_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'delivery_charge',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'delivery_charge_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'delivery_charge_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'delivery_charge_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'discount',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'promotional_discount_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'promotional_discount_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'area_panel',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'division',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'division_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'division_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'division_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'district',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'district_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'district_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'district_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'thana',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'thana_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'thana_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'thana_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'area',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'area_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'area_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'area_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'hr',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'department',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'department_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'department_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'department_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'employee',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'employee_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'employee_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'employee_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'deliveryman',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'deliveryman_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'deliveryman_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'deliveryman_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'parcel_manage',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'parcel_create',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'parcel_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'multiple_parcel_pick',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'payment',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'payment_to_merchant',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'report',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'summary_report',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'merchant_based_report',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'deliveryman_based_report',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'slider_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'discount_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'payroll',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'salary_process_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'salary_processes',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'payroll',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'salary_process_report',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'terms_condition',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'pickupman_based_report',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'payment_to_pickupman',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'payment_to_deliveryman',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'agent',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'agent_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'agent_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'agent_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'pickupman',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'pickupman_add',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'pickupman_edit',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'pickupman_delete',
                'guard_name' => 'web',
                'created_at' => '2022-06-29 09:29:29',
                'updated_at' => '2022-06-29 09:29:29',
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'pickupman_location',
                'guard_name' => 'web',
                'created_at' => '2022-09-18 04:33:15',
                'updated_at' => '2022-09-18 04:33:15',
            ),
            105 => 
            array (
                'id' => 106,
                'name' => 'deliveryman_location',
                'guard_name' => 'web',
                'created_at' => '2022-09-18 04:33:15',
                'updated_at' => '2022-09-18 04:33:15',
            ),
            105 => 
            array (
                'id' => 107,
                'name' => 'delivery_charge_package',
                'guard_name' => 'web',
                'created_at' => '2022-09-18 04:33:15',
                'updated_at' => '2022-09-18 04:33:15',
            ),
            105 => 
            array (
                'id' => 108,
                'name' => 'agent_payments',
                'guard_name' => 'web',
                'created_at' => '2022-09-18 04:33:15',
                'updated_at' => '2022-09-18 04:33:15',
            ),
        ));
        
        
    }
}