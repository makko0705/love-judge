@extends('layouts.app')

@section('title', '進行状況')

@section('content')
<div class="container page-progress">

  <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- 追加: CSRFトークンのメタタグ -->
    <h1>進行状況</h1>
    <div class="progress-bar-container">
        <div id="progressBar" class="progress-bar">0%</div>
    </div>
    <p id="progress"></p>

    <div id="imageArea">
        <img id="resultImage" src="{{ asset('images/WAN.png') }}" alt="結果画像">
    </div>
    <div class="error" style="display:none;">
        <img id="errorImage" src="{{ asset('images/SORRY.png') }}" alt="エラー画像">
        <p>エラーが発生しました。しばらくしてからもう一度お試しください。</p>
    </div>
</div>
<script src="{{ asset('js/script.js') }}"></script>
@endsection
