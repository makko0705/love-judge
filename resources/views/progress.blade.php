<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>進行状況</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <nav>
    <a href="{{ url('/') }}">診断する</a>
    <a href="{{ url('/history') }}">過去のデータ</a>
  </nav>
  <div class="container">
    <h1>進行状況</h1>
    <div class="progress-bar-container">
        <div id="progressBar" class="progress-bar">0%</div>
    </div>
    <p id="progress"></p>
  </div>

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
