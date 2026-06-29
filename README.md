# AI Coding Plan 对比工具

基于 **Laravel 8** + **MySQL** + **Bootstrap 5** 的 AI Coding Plan 套餐对比平台。

更新日期：2026.3.18

## 简介

对比国内主流 AI 平台的 Coding Plan 套餐，包括智谱 AI、Kimi、MiniMax、字节·方舟、阿里·百炼、百度·千帆、腾讯·混元等厂商的多档套餐信息。

支持模型：Qwen-3.5、Doubao-Seed-2.0、MiniMax-M2.7、MiniMax-M2.5、GLM-5、Kimi-K2.5 等

## 环境要求

- PHP >= 8.0
- MySQL >= 5.7
- Composer

## 快速开始

### 1. 安装 PHP 依赖

```bash
composer install
```

### 2. 配置环境

复制并编辑 `.env` 文件：

```bash
cp .env.example .env
php artisan key:generate
```

MySQL 配置示例：

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aihub
DB_USERNAME=root
DB_PASSWORD=your_password
```

先在 MySQL 中创建数据库：

```sql
CREATE DATABASE aihub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3. 迁移并填充数据

```bash
php artisan migrate --seed
```

### 4. 启动服务

```bash
php artisan serve
```

或运行 `run.bat`，访问 http://127.0.0.1:8000

## 项目结构

```
app/
├── Http/Controllers/PlanCompareController.php  # 对比页控制器
├── Models/                                     # Eloquent 模型
└── Services/PlanProcessor.php                  # 价格归一化逻辑
config/aihub.php                                # 页面文案配置
database/
├── migrations/                                 # 数据库迁移
└── seeders/                                    # 套餐种子数据
public/
├── css/app.css                                 # 自定义样式
└── js/compare.js                               # 筛选/排序交互
resources/views/compare/                        # Bootstrap Blade 视图
```

## 功能

- 表格 / 卡片双视图切换
- 平台、模型多选筛选
- 首月 / 包月 / 包季 / 包年价格区间筛选
- 列排序
- 套餐数据存储于 MySQL，可通过 Seeder 或后台扩展维护

## 说明

本页面数据仅供参考，价格及权益最终以平台官方公布为准。
