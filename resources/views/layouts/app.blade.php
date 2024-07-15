<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRFトークンを追加 -->
</head>
<body>
    <div id="nav">
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">診断する</a></li>
                <li><a href="{{ url('/history') }}">過去のデータ</a></li>
            </ul>
        </nav>
        <p class="close" onclick="clickBtn2()"></p>
    </div>
    <input type="button" value="MENU" onclick="clickBtn1()" id="menu-btn" />

        @yield('content')

    <script>
        //初期表示は非表示
        document.getElementById("nav").style.display ="none";

        function clickBtn1(){
            const p1 = document.getElementById("nav");
            const menubtn = document.getElementById("menu-btn");
            if(p1.style.display=="block"){
                // noneで非表示
                p1.style.display ="none";
                menubtn.style.display ="block";
            }else{
                // blockで表示
                p1.style.display ="block";
                menubtn.style.display ="none";
            }
        }

        function clickBtn2(){
            const p1 = document.getElementById("nav");
            const menubtn = document.getElementById("menu-btn");
            if(p1.style.display=="block"){
                // noneで非表示
                p1.style.display ="none";
                menubtn.style.display ="block";
            }else{
                // blockで表示
                p1.style.display ="block";
                menubtn.style.display ="none";
            }
        }
    </script>
</body>
</html>
