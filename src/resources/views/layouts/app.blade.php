<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')

</head>
<body>
    <header class="header">
        <h1 class="header-title">mogitate</h1>
    </header>
    <main class="main-content">
    
     @yield('content')
     @yield('js')
     
    </main>
</body>
</html>
