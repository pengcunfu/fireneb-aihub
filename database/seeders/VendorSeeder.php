<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    public function run()
    {
        $vendors = [
            '字节·方舟',
            'MiniMax',
            '阿里·百炼',
            '腾讯·混元',
            '百度·千帆',
            'Kimi',
            '智谱AI',
        ];

        foreach ($vendors as $index => $name) {
            Vendor::updateOrCreate(
                ['name' => $name],
                ['sort_order' => $index]
            );
        }
    }
}
