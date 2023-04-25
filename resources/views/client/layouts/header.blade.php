<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Movie booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body>
    <section class="top-bar">
        <div class="left-content">
            <h2 class="title">洗呢🐎</h2>
            <ul class="navigation">
                <li><a class="active" href="{{ route('client.home') }}">Home</a></li>

            </ul>
        </div>
        <div class="right-content">

            @if (Auth::check())
                <div class="profile-img-box">
                    <img src="../../../uploads/{{ Auth::user()->avatar }}" width="100" alt="">
                </div>
                @if (Auth::user()->role == 0)
                    <a class="text-white m-2 " href="{{ route('admin.index') }}">Quản trị</a>
                @endif
                <div class="text-white m-2">
                    <a href="{{ route('history') }}">Lịch sử mua vé</a>
                </div>
                <div class="text-white">
                    <a href="{{ route('logout') }}"> Đăng xuất</a>
                </div>
            @else
                <div class="text-white">
                    <a href="{{ route('login') }}"> Đăng nhập</a>
                </div>
            @endif
            <img src="./assets/images/menu.png" alt="" class="menu">
        </div>
    </section>
