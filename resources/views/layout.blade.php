<?php
/**
 * Created by PhpStorm.
 * User: dg
 * Date: 09.10.2019
 * Time: 11:56
 */
?>
        <!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
</head>

<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('orders') }}">Заказы</a>
                </li>
                <li>
                    <a href="{{ route('weather') }}">Погода</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>


<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>

</html>