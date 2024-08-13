# 这是一个「微博」项目
这是一个使用 Laravel 9 开发的简单的微博项目，包括用户的注册、登录、微博的创建、删除等功能。

## 微博数据
- 发布微博
- 删除微博
- 查看微博列表

## 会话控制
- 用户注册
- 用户登录
- 用户退出

## 用户功能
- 注册
- 用户激活
- 修改密码
- 邮件发送
- 个人中心
- 用户列表
- 用户删除

## 静态页面
- 首页
- 关于
- 帮助

## 社交功能
- 关注用户
- 取消关注
- 关注和粉丝列表
- 社交的统计信息
- 关注用户动态流

## 运行项目
- 将 .env.example 文件复制一份，并重命名为 .env
- 修改 .env 文件中的数据库配置为自己的配置
- 执行 `composer install` 安装依赖
- 执行 `php artisan key:generate` 生成应用密钥
- 执行 `php artisan migrate` 迁移数据库
- 为了数据库名称和大家的项目不冲突，将本地老师项目对应的数据库名称修改为 `lu_blog-laravel9` 请注意这里的数据库名称，需要和 .env 文件中的配置一致

## 今天干了些什么呢 2024-08-13
- 访问策略
    - 只有当前用户可以更新自己的个人信息
    - 未登录的用户才可以访问登录注册页面
    - 不需要登录就可以访问的页面
    - 只有登录用户才可以访问的页面
    - 只有管理员才可以删除用户并且才能看到删除按钮
- 查看用户列表
- 用户列表分页

- 今天的部分 laravel 命令
    - `php artisan migrate` 迁移数据库
    - `php artisan make:policy UserPolicy` 创建用户策略
    - `php artisan migrate:refresh` 重置数据库
    - `php artisan migrate:refresh --seed` 重置数据库并填充数据
    - `php artisan make:seed UsersTableSeeder` 创建用户数据填充
    - `php artisan db:seed --class=UsersTableSeeder` 填充用户数据
    - `php artisan make:migration add_is_admin_to_users_table --table=users` 添加管理员字段

