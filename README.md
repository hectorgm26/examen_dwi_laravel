# Laravel 12

## Creamos 2 vistas

1. Vista para la landing page

```bash
php artisan make:view landing/index
```

2. Vista para el login
```bash
php artisan make:view backoffice/users/login
```

## En el archivo landing page

```php
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body class="container">
    <h1 class="text-primary">Landing Page</h1>
    <h3>Esta es una landing page...</h3>
    <a href="/login"><button class="btn btn-primary">Iniciar Sesión</button></a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>

</html>
```

## En el archivo de rutas

```php
Route::get('/', function () {
    return view('landing/index');
});

Route::get('/login', function () {
    return view('backoffice/users/login');
});

Route::post('/login', function () {
    return view('backoffice/users/login');
});
```

## Creamos un controlador para el usuario

```bash
php artisan make:controller UserController
```