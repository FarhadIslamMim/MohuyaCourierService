<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ParceltypesTableSeeder::class);
        $this->call(AboutsTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(BannersTableSeeder::class);
        $this->call(CodchargesTableSeeder::class);
        $this->call(DeliverychargesTableSeeder::class);
        $this->call(DeliveryChargeHeadTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(ThanasTableSeeder::class);
        $this->call(DivisionsTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(WeightsTableSeeder::class);
    }
}
