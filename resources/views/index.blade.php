@extends('layouts.app')

@section('title', 'LINE履歴登録')

@section('content')
    {{-- <h1>LINE履歴登録</h1> --}}
    <input type="text" id="userName" placeholder="あなたの名前を入力してください" />
    <input type="file" id="file" />
    <textarea id="chatHistory" rows="10" placeholder="ここにLINE履歴を入力してください..." readonly hidden></textarea>
    <button class="btn" id="analyzeButton">Analyze</button>

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
@endsection
