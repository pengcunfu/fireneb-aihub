<?php

namespace Database\Seeders;

use App\Models\NavCategory;
use Illuminate\Database\Seeder;

class NavCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => '对话模型', 'slug' => 'dui-hua-mo-xing', 'icon' => '💬', 'description' => '大语言模型与 AI 助手', 'sort_order' => 1],
            ['name' => 'AI 编程', 'slug' => 'ai-bian-cheng', 'icon' => '⌨️', 'description' => '代码补全、Agent 与 IDE 插件', 'sort_order' => 2],
            ['name' => 'AI 图像', 'slug' => 'ai-tu-xiang', 'icon' => '🎨', 'description' => '文生图、图像编辑与设计', 'sort_order' => 3],
            ['name' => 'AI 视频', 'slug' => 'ai-shi-pin', 'icon' => '🎬', 'description' => '文生视频与视频编辑', 'sort_order' => 4],
            ['name' => 'AI 办公', 'slug' => 'ai-ban-gong', 'icon' => '📄', 'description' => '文档、演示与效率工具', 'sort_order' => 5],
            ['name' => '开发平台', 'slug' => 'kai-fa-ping-tai', 'icon' => '⚙️', 'description' => '模型 API 与云服务平台', 'sort_order' => 6],
        ];

        foreach ($categories as $cat) {
            NavCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                array_merge($cat, ['is_active' => true])
            );
        }
    }
}
