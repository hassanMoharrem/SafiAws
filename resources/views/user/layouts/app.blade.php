<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="theme-color" content="#000000"/>
    <title>Manea Ticket</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo-white.png') }}">
    @vite(['resources/js/app.js','resources/sass/app.scss'])
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
<header>
    <div class="container">
        <div class="row mx-auto w-100 g-0">
            <div class="col-6 my-2 my-md-auto">
                <img src="{{ asset('assets/images/logo.jpeg') }}" width="36" height="41" alt="Manea Ticket">
                <h5 class="font-size-20 d-inline-block ms-1 align-middle mb-0">Manea Ticket</h5>
            </div>
            <div class="col-6 my-2 my-md-auto text-end">
                <select class="form-select d-inline-block border border-muted" aria-label="Default select example">
                    <option value="en" selected>English</option>
                    <option value="ar">Arabic</option>
                </select>
                <a href="" class="ms-3"><img src="assets/images/moon.svg" width="15" alt=""></a>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="main d-flex">
        <div class="sidebar width-94">
            <div class="text-center position-relative h-100 pb-2">
                <a href="{{ route('user.dashboard') }}" class="pt-50 d-block"><img src="{{ asset('assets/images/home') }}{{ request()->is('dashboard') ? '-active.svg' : '.svg' }}" width="21" alt=""></a>
                <a href="all-asset.html" class="pt-50 d-block"><img src="assets/images/asset.svg" width="21" alt=""></a>
                <a href="{{ route('user.profile') }}" class="pt-50 d-block"><img src="{{ asset('assets/images/shield') }}{{ request()->is('profile') ? '-active.svg' : '.svg' }}" width="20" alt=""></a>
                <a href="threats.html" class="pt-50 d-block"><img src="assets/images/bug.svg" width="20" alt=""></a>
                <a href="global.html" class="pt-50 d-block"><img src="assets/images/global.svg" width="20" alt=""></a>
                <a href="" class="pt-50 d-block"><img src="assets/images/support.svg" width="20" alt=""></a>
                <a href="" class="pt-50 d-block"><img src="assets/images/report.svg" width="20" alt=""></a>
                <a href="{{ route('logout') }}" class="pt-50 d-block"><img src="assets/images/logout.svg" width="20" alt=""></a>
            </div>
        </div>
        <div class="width-calc ps-2 pt-2 pb-5">
            @yield('content')
        </div>
    </div>
</main>
</body>
</html>
