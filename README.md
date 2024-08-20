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

## 今天做了写什么 2024-08-14

- 账户激活
    - 用于激活新注册的用户

    1. 用户注册成功后，自动生成激活令牌
    2. 将激活令牌以链接的形式附带在注册邮件里面，并将邮件发送到用户的注册邮箱上
    3. 用户在点击注册链接跳到指定路由，路由收到激活令牌参数后映射给相关的控制器来处理
    4. 控制器拿到激活令牌并进行验证，验证通过之后对该用户进行激活，并将其激活状态设置未已激活
    5. 用户激活成功之后，自动登录
- 用户密码重设
    - 帮助用户找回密码
- 邮件发送
- ## 今天做了写什么 2024-08-15

- 用户密码重设
    - 用于用户忘记密码时，通过邮箱重设密码

    1. 用户点击忘记密码链接，跳转到重设密码页面
    2. 用户在重设密码页面输入邮箱，点击发送邮件
    3. 系统生成重设密码令牌，并将令牌以链接的形式附带在邮件里面发送到用户的邮箱
    4. 用户点击邮件里面的链接，跳转到重设密码页面
    5. 用户在重设密码页面输入邮箱和新密码，点击提交
    6. 控制器对用户的邮箱和密码重置令牌验证，验证通过之后更新用户的密码

- 配置生产环境中的真实邮件发送

## 今天做了写什么 2024-08-16
实现微博的 CRUD 功能
- 创建微博数据模型
    - `php artisan make:migration create_statuses_table --create="statuses"` 创建微博数据表迁移文件
- 显示微博列表
    - `php artisan make:controller StatusesController` 创建微博控制器
    - `php artisan make:model Models/Status` 创建微博模型
    - `php artisan make:policy StatusPolicy` 创建微博策略
- 通过模型工厂和数据填充生成微博数据
    - `php artisan make:factory StatusFactory` 创建微博工厂
    - `php artisan make:seeder StatusesTableSeeder` 创建微博数据填充
    - `php artisan migrate:refresh --seed` 重置数据库并填充数据
- 发布微博
- 首页显示微博列表
- 删除微博
    - 只有微博的作者才可以删除微博，否则不显示删除按钮


## 今天做了写什么 2024-08-19
- 用户 A 访问用户 B 的个人页面浏览
- 用户 A 关注用户 B，通过点击用户 B 的个人页面上的关注按钮
- 关注之后用户 A 将出现在用户 B 的粉丝列表中，用户 B 将出现在用户 A 的关注列表中
- 用户 A 在访问网站主页时，可以看到好友和自己发布的动态
- 创建一个新的分支来实现社交功能，`git checkout -b following-users`
- 创建关注关系表
    - `php artisan make:migration create_followers_table --create="followers"` 创建关注关系表迁移文件
    - `php artisan migrate` 迁移数据库
- 可以使用 `php artisan tinker` 来测试关注关系
    - `App\Models\User::find(1)->followings()->sync([2, 3])` 用户 1 关注了用户 2 和用户 3
    - `App\Models\User::find(1)->followings()->detach(2)` 用户 1 取消关注用户 2
    - `App\Models\User::find(1)->followings` 查看用户 1 关注的用户
    - `App\Models\User::find(1)->followers` 查看用户 1 的粉丝

- 统计信息
    - 用户的关注数、粉丝数、微博数
    - 创建了用户关注关系表的数据填充 `php artisan make:seeder FollowersTableSeeder`
    - 重新执行数据填充 `php artisan migrate:refresh --seed` （注意：这里会清空所有数据，生产环境禁止使用！！！）
    - 创建了 FollowersController 控制器，用于显示用户的关注列表和粉丝列表，`php artisan make:controller FollowersController`
    - 修改了授权策略，限制自己不能关注自己
## 今天做了写什么 2024-08-20
- 动态流
    - 在主页显示自己的微博和关注的用户的微博
    
