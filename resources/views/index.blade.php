@extends('layouts.app')

@section('title', 'LINE履歴登録')

@section('content')
<div class="slide_wrap" id="howto_wrap">
    <h1><img src="images/h1_howto.png" alt="使い方"></h1>
    <p class="read">このアプリはLINEのトーク履歴を使用して、<br>
        恋愛の可能性をジャッジします。</p>
    <ul class="slick01">
        <li><img alt="使い方1" src="images/slide01.png" /></li>
        <li><img alt="使い方2" src="images/slide02.png" /></li>
        <li><img alt="使い方3" src="images/slide03.png" /></li>
        <li><img alt="診断について" src="images/slide04.png" /></li>
    </ul>
    <p id="close_howto"><span>診断を始める</span></p>
</div>
<div class="container page-index">
    <h1><img src="images/h1_index.png" alt="診断する"></h1>
    <input type="text" id="userName" placeholder="LINEの名前を正確に入力してください" />
    <input type="file" id="file" />
    <textarea id="chatHistory" rows="10" placeholder="ここにLINE履歴を入力してください..." readonly hidden></textarea>
    <button class="btn" id="analyzeButton">診断する</button>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $('.slick01').slick({
        autoplay: false,
        dots: true,
        responsive: [{
            breakpoint: 640,
            settings: {
                arrows: false,
                slidesToShow: 1,
                centerPadding: "10%",
            },
        }, ],
    });

    function closeHowto() {
        const close_howto = document.getElementById("close_howto");
        const howto_wrap = document.getElementById("howto_wrap");
        if (close_howto.style.display == "block") {
            close_howto.style.display = "none";
            howto_wrap.style.display = "none";
        } else {
            close_howto.style.display = "block";
            howto_wrap.style.display = "block";
        }
    }
    $('#close_howto').click(function() {
        $('#howto_wrap').hide();
    })

    const textarea = document.querySelector('#chatHistory');
    document.querySelector('#file').addEventListener('change', e => {
        if (e.target.files[0]) {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = e => {
                textarea.value = e.target.result;
            };
            reader.readAsText(file);
            sessionStorage.setItem('fileName', file.name); // ファイル名をセッションに保存
        }
    });

    document.getElementById('analyzeButton').addEventListener('click', () => {
        const fullChatHistory = document.getElementById('chatHistory').value;
        const userName = document.getElementById('userName').value;

        // チャット履歴の末尾部分を取得
        const maxLength = 8000; // トークン数の制限に合わせて適宜変更
        const truncatedChatHistory = fullChatHistory.slice(-maxLength);

        sessionStorage.setItem('chatHistory', truncatedChatHistory);
        sessionStorage.setItem('userName', userName);
        window.location.href = 'progress';
    });
</script>
@endsection
