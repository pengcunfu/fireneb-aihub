# AIHub - AI 导航 + Coding Plan 对比

基于 **Laravel 8** + **MySQL** + **Bootstrap 5** 的 AI 工具导航与 Coding Plan 套餐对比平台。

## 功能模块

| 模块 | 路由 | 状态 |
|------|------|------|
| AI 导航 | `/` | ✅ 已上线 |
| Coding Plan 对比 | `/coding-plan` | ✅ 已上线 |
| AI 论坛 | - | 🔜 规划中 |
| 社区 | - | 🔜 规划中 |
| AI 工具 | - | 🔜 规划中 |

## 快速开始

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

MySQL 配置（`.env`）：

```env
DB_DATABASE=aihub
DB_USERNAME=root
DB_PASSWORD=your_password
```

## 项目结构

```
app/
├── Http/Controllers/
│   ├── HomeController.php          # AI 导航首页
│   └── PlanCompareController.php   # Coding Plan 对比
├── Models/
│   ├── NavCategory.php / NavLink.php   # 导航数据
│   └── Plan.php / Vendor.php ...       # 套餐数据
config/aihub.php                    # 站点与模块配置
database/seeders/                   # 导航 + 套餐种子数据
resources/views/
├── home/                           # AI 导航页
├── compare/                        # Coding Plan 页
└── partials/navbar.blade.php       # 全站导航
public/js/nav.js                    # 导航筛选交互
public/js/compare.js                # 套餐对比交互
```

## 说明

收录链接与套餐数据仅供参考，请以各平台官方信息为准。
