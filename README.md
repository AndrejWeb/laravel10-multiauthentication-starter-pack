<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel 10 Multiauthentication Starter Pack

This is a demo app which demonstrates different content being shown for 3 user types: admin, user and viewer. Depending on the user type, the user can access the authorized content. Admins can see admin intended content, users can see user intended content and viewers can see viewer intended content.

### How it's done?

In the migration `create_users_table`, a new field called `role` is added

`$table->string('role');`

Suggested values for this column in the database table are: `admin`, `user`, `viewer`

In the model `User` there are 3 functions `isAdmin`, `isUser`, `isViewer` which check the user type. Here's the code for `isAdmin`

```
public function isAdmin()
{
    return $this->role === 'admin';
}
```

There are middlewares for each user type - `AdminMiddleware`, `UserMiddleware`, `ViewerMiddleware`. Their code is similar. Here's the code for `AdminMiddleware`

```
public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        return redirect('/');
    }
```

The middlewares are given alias names in `app\Http\Kernel.php` in the array `protected $middlewareAliases`. Then the middlewares are assigned to routes in `routes\web.php`

In order to render the appropriate menu items for each user and user specific page content, 3 custom Blade directive are created - `ifAdmin`, `ifUser`, `ifViewer`. Check out `app\Providers\BladeServiceProvider.php` file for this and `resources\views\layouts\navigation.blade.php` how they are used.

### How to use the app

Download / clone the repository.

Copy / rename `.env.example` to `.env`. Enter your database credentials in `.env`

Run these commands in terminal in the app's root directory:

1) `composer install`
2) `php artisan breeze:install`
3) `php artisan migrate`
4) `npm install`
5) `npm run dev`

Open another terminal and run the db:seed command, so you have 3 users added in the table `users` via the seeder `UserSeeder.php` located in `app\database\seeders\UserSeeder.php`. In this file you can see the users email and password. Use them to login later.

6) `php artisan db:seed`
7) `php artisan serve`

Now the application should be running at `http://localhost:8000`

Login as each user type to see the user intended content. Try to access route which you are not authorized to view and you will be redirected to home page.

### Screenshots
<img src="https://i.imgur.com/PDdvT68.jpg" />

<img src="https://i.imgur.com/jELTO4P.jpg" />

<img src="https://i.imgur.com/9YyKnTn.jpg" />

<img src="https://i.imgur.com/B1bKHGz.jpg" />

<img src="https://i.imgur.com/YD9mL8B.jpg" />

<img src="https://i.imgur.com/W6q3r9k.jpg" />
