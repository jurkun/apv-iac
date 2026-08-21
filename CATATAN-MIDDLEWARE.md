# Registrasi middleware EnsureAdminPusat

Laravel 11 (bootstrap/app.php):
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin_pusat' => \App\Http\Middleware\EnsureAdminPusat::class,
    ]);
})
```

Laravel 10 ke bawah (app/Http/Kernel.php), tambahkan di $routeMiddleware:
```php
'admin_pusat' => \App\Http\Middleware\EnsureAdminPusat::class,
```

Lalu pakai di route yang hanya boleh diakses admin pusat, misalnya kelola akun pengurus wilayah:
```php
Route::middleware(['auth', 'admin_pusat'])->group(function () {
    // route khusus admin pusat, mis. Route::resource('users', UserController::class);
});
```
