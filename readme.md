<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## วิธีติดตั้ง
1. อัพเดท composer package ด้วยคำสั่งนี้
``` bash
composer update
```

1. อัพเดท node_module ด้วยคำสั่งนี้
``` bash
npm install
// หาก error ให้สั่งคำสั่งนี้ npm audit fix --force
```
2. compile webpack
``` bash
npm run dev
//กรณี compile สำเร็จจะขึ้นตามนี้
 DONE  Compiled successfully in 10171ms 14:31:03                           
```
3. แก้ไขไฟล์ .env ให้เชื่อมต่อกับฐานข้อมูล
``` bash
DB_CONNECTION=mysql <-- ชื่อ connection
DB_HOST=127.0.0.1 <-- ip database server
DB_PORT=3306 <-- port database server
DB_DATABASE=demo <-- ชื่อ database
DB_USERNAME=root <-- username สำหรับ connect เข้า database
DB_PASSWORD= xxxx <-- password สำหรับ connect เข้า database
```
4. generate laravel key
``` bash
php artisan key:generate
```

## กรณี error 
comment code ที่ไฟล์ app\Providers\PermissionsServiceProvider.php ก่อนสั่ง php artisan migrate 
```php
Permission::get()->map(function($permission){
	Gate::define($permission->slug, function($user) use ($permission){
		return $user->hasPermissionTo($permission);
	});
});
```
5. สั่ง migrate เพื่อสร้าง table ที่จำเป็น
``` bash
php artisan migrate
```

6. สั่ง db:seed เพื่อ insert ข้อมูลเริ่มต้น
``` bash
php artisan db:seed
```
7. เริ่มต้น local server โดยการ cmd ไป root directory และสั่งคำสั่งดังนี้
``` bash
php -S localhost:8100 -t public
```

## User สำหรับเข้าระบบ

| id        |username          | password  |  role  | 
| -------------      |:-------------:| :-----:| :-----:|
| 1 |admin@gmail.com    | Welcome1 | Admin |
| 2 | user@gmail.com  | Welcome1 | User|

## Permission เริ่มต้น

| id        | slug          | name  |
| -------------      |:-------------:| :-----:|
| 1 | view-dashboard    | View Dashboard |
| 2 | view-template    | View Template |
| 3 | view-form    | View Form |
| 4 | create-form |  Create Form |
| 5 | edit-form     |  Edit Form |
| 6 | delete-form |  Delete Form |

## Role เริ่มต้น

| id        | slug          | name  |
| -------------      |:-------------:| :-----:|
| 1 | admin    | Administrator |
| 2 | user |  User |

## ตัวอย่างการใช้งานกับหน้า View
```php
@role('admin')

<h1>Hello from the admin</h1>

@endrole
```
## Setup RoleMiddleware
``` bash
php artisan make:middleware RoleMiddleware
```

แก้ไขฟังก์ชัน handle ที่ไฟล์ RoleMiddleware
``` php
public function handle($request, Closure $next, $role, $permission = null)
 {
   if(!$request->user()->hasRole($role)) {
     abort(404);
  }
  if($permission !== null && !$request->user()->can($permission)) {
      abort(404);
  }
     return $next($request);
 }
 ```
 
 ## เพิ่ม RoleMiddleware ที่ไฟล์ Kernel.php
``` php
protected $routeMiddleware = [
         // ...
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];
```

## ตัวอย่างการใช้งาน RoleMiddleware ที่ไฟล์ web.php
``` php
Route::group(['middleware' => 'role:admin'], function() {
   Route::get('/admin', function() {
      return 'Welcome Admin';
   });
});
```

## ทดสอบ role & permisssion ผ่าน command dd()
``` php
$user = $request->user();
dd($user->hasRole('admin')); //จะ return True ก็ต่อเมื่อ User มี Role นั้น
dd($user->givePermissionsTo('create-form')); // เพิ่ม Permission ให้กับ User
dd($user->can('edit-form')); //จะ return True ก็ต่อเมื่อ User มี Permission นั้น
```