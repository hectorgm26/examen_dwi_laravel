<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body class="container">
    <h3>{{ $instruccion }}</h3>
    @if (session('success'))
        <div class="alert alert-success mb-4">
            <ul>{{ session('success') }}</ul>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger"> {{-- O usa tus clases CSS para estilo (ej. text-red-500, bg-red-100) --}}
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="text-center" action="{{ route('user.form.login') }}" method="POST">
        @csrf
        <input type="email" class="mb-2 form-control" name="username" placeholder="Username" autofocus value="scabezas@ciisa.cl">
        <input type="password" class="mb-2 form-control" name="password" placeholder="******" value="holaMundo">
        <button type="submit" class="mb-2 btn btn-primary">Login</button>
    </form>
    <a href="/">Volver a la raiz</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>
</html>
