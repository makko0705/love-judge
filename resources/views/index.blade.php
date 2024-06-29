<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LINE履歴登録</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <nav>
    <a href="{{ url('/') }}">診断する</a>
    <a href="{{ url('/history') }}">過去のデータ</a>
  </nav>
  <div class="container">
    <h1>LINE履歴登録</h1>
    <input type="text" id="userName" placeholder="あなたの名前を入力してください" />
    <input type="file" id="file" />
    <textarea id="chatHistory" rows="10" placeholder="ここにLINE履歴を入力してください..." readonly></textarea>
    <button id="analyzeButton">Analyze</button>
  </div>

  <script>
    const textarea = document.querySelector('#chatHistory');
    document.querySelector('#file').addEventListener('change', e => {
        if (e.target.files[0]) {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = e => {
                textarea.value = e.target.result;
            };
            reader.readAsText(file);
        }
    });

    document.getElementById('analyzeButton').addEventListener('click', () => {
        sessionStorage.setItem('chatHistory', document.getElementById('chatHistory').value);
        sessionStorage.setItem('userName', document.getElementById('userName').value);
        window.location.href = 'progress';
    });
  </script>
</body>
</html>
