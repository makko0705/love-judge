@extends('layouts.app')

@section('title', 'LINE履歴登録')

@section('content')
    <input type="text" id="userName" placeholder="あなたの名前を入力してください" />
    <input type="file" id="file" />
    <textarea id="chatHistory" rows="10" placeholder="ここにLINE履歴を入力してください..." readonly hidden></textarea>
    <button class="btn" id="analyzeButton">Analyze</button>

    <script>
        const MAX_CHAT_HISTORY_LENGTH = 7000; // 最大チャット履歴長を設定

        const textarea = document.querySelector('#chatHistory');
        document.querySelector('#file').addEventListener('change', e => {
            if (e.target.files[0]) {
                const file = e.target.files[0];
                const reader = new FileReader();
                reader.onload = e => {
                    let chatHistory = e.target.result;
                    if (chatHistory.length > MAX_CHAT_HISTORY_LENGTH) {
                        chatHistory = chatHistory.substring(0, MAX_CHAT_HISTORY_LENGTH);
                        alert('チャット履歴が長すぎるため、先頭の部分だけが解析されます。');
                    }
                    textarea.value = chatHistory;
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
@endsection
