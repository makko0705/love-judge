@extends('layouts.app')

@section('title', 'LINE履歴登録')

@section('content')
<div class="container page-howto">
<div class="slide_wrap">
    <h1><img src="images/h1_howto.png" alt="使い方"></h1>
    <p class="read">このアプリはLINEのトーク履歴を使用して、<br>
        恋愛の可能性をジャッジします。</p>
    <ul class="slick01">
        <li><img alt="使い方1" src="images/slide01.png" /></li>
        <li><img alt="使い方2" src="images/slide02.png" /></li>
        <li><img alt="使い方3" src="images/slide03.png" /></li>
        <li><img alt="診断について" src="images/slide04.png" /></li>
    </ul>
</div>

</div>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script>
    $('.slick01').slick({ //{}を入れる
    autoplay: false, //「オプション名: 値」の形式で書く
    dots: true,
    responsive: [
            {
                breakpoint: 640,
        settings: {
            // 変えたいオプションを指定。
            arrows: false,
            slidesToShow: 1,
            centerPadding: "10%",
        },
    },
        ],
  });
  </script>

@endsection
