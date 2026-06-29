<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run()
    {
        SiteSetting::updateOrCreate(
            ['key' => 'app_config'],
            ['value' => config('aihub')]
        );
    }
}
