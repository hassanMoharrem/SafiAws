<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Manea Ticket</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo-white.png') }}">
    <!-- My own style -->
    @vite(['resources/js/app.js','resources/sass/app.scss'])
    <link rel="stylesheet" href="{{ asset('assets/css/user/style.css') }}">
    <link rel="icon" href="{{ asset('assets/images/logo-manea.png') }}">
</head>
<body class="dark-them">
@yield('content')

@yield('js_code')
</body>
</html>



