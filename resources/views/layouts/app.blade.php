<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Siêu thị mini KMax | Mua sắm online')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    @stack('styles') {{-- Để nạp thêm CSS riêng cho từng trang --}}

</head>
<body class="">

@include('partials.header') {{-- Nạp Header --}}

<main>
    @yield('content') {{-- Nơi đổ nội dung của các trang con --}}
</main>

@include('partials.footer') {{-- Nạp Footer --}}

@stack('scripts') {{-- Để nạp thêm JS riêng cho từng trang --}}

</body>
</html>
