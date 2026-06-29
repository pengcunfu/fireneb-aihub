<?php

namespace Database\Seeders;

use App\Models\NavCategory;
use App\Models\NavLink;
use Illuminate\Database\Seeder;

class NavLinkSeeder extends Seeder
{
    public function run()
    {
        $links = [
            'dui-hua-mo-xing' => [
                ['name' => 'ChatGPT', 'url' => 'https://chat.openai.com', 'description' => 'OpenAI 旗舰对话模型，支持 GPT-4o 等多模态能力', 'tags' => ['海外', '多模态'], 'is_domestic' => false, 'is_featured' => true, 'sort_order' => 1],
                ['name' => 'Claude', 'url' => 'https://claude.ai', 'description' => 'Anthropic 出品，长文本与代码能力突出', 'tags' => ['海外', '编程'], 'is_domestic' => false, 'is_featured' => true, 'sort_order' => 2],
                ['name' => 'Gemini', 'url' => 'https://gemini.google.com', 'description' => 'Google 多模态 AI 助手', 'tags' => ['海外', '免费'], 'is_domestic' => false, 'is_featured' => false, 'sort_order' => 3],
                ['name' => 'Kimi', 'url' => 'https://kimi.moonshot.cn', 'description' => '月之暗面，超长上下文与国内访问友好', 'tags' => ['国内', '长文本'], 'is_domestic' => true, 'is_featured' => true, 'sort_order' => 4],
                ['name' => '通义千问', 'url' => 'https://tongyi.aliyun.com', 'description' => '阿里云大模型，Qwen 系列', 'tags' => ['国内', '免费'], 'is_domestic' => true, 'is_featured' => true, 'sort_order' => 5],
                ['name' => '智谱清言', 'url' => 'https://chatglm.cn', 'description' => '智谱 AI GLM 系列对话产品', 'tags' => ['国内'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 6],
                ['name' => '文心一言', 'url' => 'https://yiyan.baidu.com', 'description' => '百度 ERNIE 大模型对话', 'tags' => ['国内'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 7],
                ['name' => '豆包', 'url' => 'https://www.doubao.com', 'description' => '字节跳动 AI 助手', 'tags' => ['国内', '免费'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 8],
                ['name' => 'DeepSeek', 'url' => 'https://chat.deepseek.com', 'description' => '深度求索，推理与代码能力强', 'tags' => ['国内', '编程'], 'is_domestic' => true, 'is_featured' => true, 'sort_order' => 9],
                ['name' => '腾讯混元', 'url' => 'https://hunyuan.tencent.com', 'description' => '腾讯自研大模型', 'tags' => ['国内'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 10],
            ],
            'ai-bian-cheng' => [
                ['name' => 'Cursor', 'url' => 'https://cursor.com', 'description' => 'AI 原生代码编辑器，Agent 编程体验领先', 'tags' => ['海外', 'IDE'], 'is_domestic' => false, 'is_featured' => true, 'sort_order' => 1],
                ['name' => 'GitHub Copilot', 'url' => 'https://github.com/features/copilot', 'description' => 'GitHub 官方 AI 编程助手', 'tags' => ['海外', '插件'], 'is_domestic' => false, 'is_featured' => true, 'sort_order' => 2],
                ['name' => 'Windsurf', 'url' => 'https://codeium.com/windsurf', 'description' => 'Codeium 推出的 AI IDE', 'tags' => ['海外', 'IDE'], 'is_domestic' => false, 'is_featured' => false, 'sort_order' => 3],
                ['name' => 'Trae', 'url' => 'https://www.trae.ai', 'description' => '字节跳动 AI 编程 IDE', 'tags' => ['国内', 'IDE'], 'is_domestic' => true, 'is_featured' => true, 'sort_order' => 4],
                ['name' => '通义灵码', 'url' => 'https://lingma.aliyun.com', 'description' => '阿里云 AI 编程助手插件', 'tags' => ['国内', '插件'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 5],
                ['name' => 'CodeGeeX', 'url' => 'https://codegeex.cn', 'description' => '智谱 AI 代码大模型与插件', 'tags' => ['国内', '插件'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 6],
                ['name' => 'Codeium', 'url' => 'https://codeium.com', 'description' => '免费 AI 代码补全，多 IDE 支持', 'tags' => ['海外', '免费'], 'is_domestic' => false, 'is_featured' => false, 'sort_order' => 7],
                ['name' => 'Kimi Code', 'url' => 'https://www.kimi.com/code', 'description' => 'Kimi 编程专属入口与 Coding Plan', 'tags' => ['国内', 'Coding Plan'], 'is_domestic' => true, 'is_featured' => true, 'sort_order' => 8],
            ],
            'ai-tu-xiang' => [
                ['name' => 'Midjourney', 'url' => 'https://www.midjourney.com', 'description' => '高质量 AI 艺术图像生成', 'tags' => ['海外'], 'is_domestic' => false, 'is_featured' => true, 'sort_order' => 1],
                ['name' => 'DALL·E', 'url' => 'https://openai.com/dall-e-3', 'description' => 'OpenAI 图像生成模型', 'tags' => ['海外'], 'is_domestic' => false, 'is_featured' => false, 'sort_order' => 2],
                ['name' => 'Stable Diffusion', 'url' => 'https://stability.ai', 'description' => '开源图像生成生态', 'tags' => ['开源'], 'is_domestic' => false, 'is_featured' => false, 'sort_order' => 3],
                ['name' => '即梦 AI', 'url' => 'https://jimeng.jianying.com', 'description' => '字节跳动 AI 图像与视频创作', 'tags' => ['国内', '免费'], 'is_domestic' => true, 'is_featured' => true, 'sort_order' => 4],
                ['name' => 'LiblibAI', 'url' => 'https://www.liblib.art', 'description' => '国内 AI 绘画模型社区', 'tags' => ['国内'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 5],
                ['name' => '文心一格', 'url' => 'https://yige.baidu.com', 'description' => '百度 AI 艺术画生成', 'tags' => ['国内'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 6],
            ],
            'ai-shi-pin' => [
                ['name' => 'Runway', 'url' => 'https://runwayml.com', 'description' => '专业 AI 视频生成与编辑', 'tags' => ['海外'], 'is_domestic' => false, 'is_featured' => true, 'sort_order' => 1],
                ['name' => 'Pika', 'url' => 'https://pika.art', 'description' => 'AI 视频生成平台', 'tags' => ['海外'], 'is_domestic' => false, 'is_featured' => false, 'sort_order' => 2],
                ['name' => '可灵 AI', 'url' => 'https://klingai.kuaishou.com', 'description' => '快手 AI 视频生成', 'tags' => ['国内'], 'is_domestic' => true, 'is_featured' => true, 'sort_order' => 3],
                ['name' => 'Sora', 'url' => 'https://openai.com/sora', 'description' => 'OpenAI 文生视频模型', 'tags' => ['海外'], 'is_domestic' => false, 'is_featured' => true, 'sort_order' => 4],
                ['name' => '海螺 AI', 'url' => 'https://hailuoai.com', 'description' => 'MiniMax 视频与语音产品', 'tags' => ['国内'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 5],
            ],
            'ai-ban-gong' => [
                ['name' => 'Notion AI', 'url' => 'https://www.notion.so/product/ai', 'description' => '笔记与知识库 AI 助手', 'tags' => ['海外'], 'is_domestic' => false, 'is_featured' => true, 'sort_order' => 1],
                ['name' => 'WPS AI', 'url' => 'https://ai.wps.cn', 'description' => 'WPS 办公套件 AI 功能', 'tags' => ['国内'], 'is_domestic' => true, 'is_featured' => true, 'sort_order' => 2],
                ['name' => 'Gamma', 'url' => 'https://gamma.app', 'description' => 'AI 生成演示文稿与文档', 'tags' => ['海外', '免费'], 'is_domestic' => false, 'is_featured' => false, 'sort_order' => 3],
                ['name' => '飞书多维表格', 'url' => 'https://www.feishu.cn/product/base', 'description' => '飞书 AI 增强的数据协作', 'tags' => ['国内'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 4],
                ['name' => '秘塔 AI 搜索', 'url' => 'https://metaso.cn', 'description' => '无广告 AI 搜索引擎', 'tags' => ['国内', '免费'], 'is_domestic' => true, 'is_featured' => true, 'sort_order' => 5],
            ],
            'kai-fa-ping-tai' => [
                ['name' => 'OpenAI Platform', 'url' => 'https://platform.openai.com', 'description' => 'GPT 系列 API 官方平台', 'tags' => ['海外', 'API'], 'is_domestic' => false, 'is_featured' => true, 'sort_order' => 1],
                ['name' => 'Anthropic Console', 'url' => 'https://console.anthropic.com', 'description' => 'Claude API 开发者平台', 'tags' => ['海外', 'API'], 'is_domestic' => false, 'is_featured' => false, 'sort_order' => 2],
                ['name' => '阿里云百炼', 'url' => 'https://bailian.console.aliyun.com', 'description' => '通义系列模型 API 与 Coding Plan', 'tags' => ['国内', 'API'], 'is_domestic' => true, 'is_featured' => true, 'sort_order' => 3],
                ['name' => '火山方舟', 'url' => 'https://www.volcengine.com/product/ark', 'description' => '字节跳动模型服务平台', 'tags' => ['国内', 'API'], 'is_domestic' => true, 'is_featured' => true, 'sort_order' => 4],
                ['name' => '百度千帆', 'url' => 'https://cloud.baidu.com/product/wenxinworkshop', 'description' => '文心大模型开发平台', 'tags' => ['国内', 'API'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 5],
                ['name' => '智谱开放平台', 'url' => 'https://open.bigmodel.cn', 'description' => 'GLM 系列 API 与 Coding Plan', 'tags' => ['国内', 'API'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 6],
                ['name' => 'MiniMax 开放平台', 'url' => 'https://platform.minimaxi.com', 'description' => 'MiniMax 模型 API 服务', 'tags' => ['国内', 'API'], 'is_domestic' => true, 'is_featured' => false, 'sort_order' => 7],
            ],
        ];

        foreach ($links as $slug => $items) {
            $category = NavCategory::where('slug', $slug)->first();
            if (!$category) {
                continue;
            }

            foreach ($items as $item) {
                NavLink::updateOrCreate(
                    [
                        'nav_category_id' => $category->id,
                        'name' => $item['name'],
                    ],
                    array_merge($item, [
                        'nav_category_id' => $category->id,
                        'is_active' => true,
                    ])
                );
            }
        }
    }
}
