<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Новостной сайт')</title>
</head>
<body>
    <x-header />
    
    <main>
        @yield('content')
    </main>
    
    <x-footer />
</body>
</html>