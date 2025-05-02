<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Tarea UD7 DWCS</title>
</head>
<body>
    @include('partials.header')

<!-- mt-4 añade margen superior al main y mb-4 margen inferior (24px)-->
    <main class="mt-4 mb-4">
    @yield('content')

    </main>

    @include('partials.footer')
</body>
</html>