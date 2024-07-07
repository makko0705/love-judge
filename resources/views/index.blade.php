@extends('layouts.app')

@section('title', 'LINE履歴登録')

@section('content')
<div class="container page-history">

    <input type="text" id="userName" placeholder="あなたの名前を入力してください" />
    <input type="file" id="file" />
    <textarea id="chatHistory" rows="10" placeholder="ここにLINE履歴を入力してください..." readonly hidden></textarea>
    <button class="btn" id="analyzeButton">Analyze</button>
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
