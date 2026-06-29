<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            NavCategorySeeder::class,
            NavLinkSeeder::class,
            VendorSeeder::class,
            PlanSeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}
