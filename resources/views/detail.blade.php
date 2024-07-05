<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>診断詳細</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <nav>
    <a href="{{ url('/') }}">診断する</a>
    <a href="{{ url('/history') }}">過去のデータ</a>
  </nav>
  <div class="container">
    <h1>{{ $consultation->partner_name }} さんの診断詳細</h1>
    @if ($consultation->diagnoses->isNotEmpty())
        @php
            $diagnosis = $consultation->diagnoses->first();
            $diagnosisContent = json_decode($diagnosis->diagnosis_content, true);
        @endphp
        <div id="imageArea">
            @if ($diagnosisContent['GOorWAIT'] === 'GO')
                <img id="resultImage" src="{{ asset('images/GO.png') }}" alt="GO">
            @else
                <img id="resultImage" src="{{ asset('images/WAIT.png') }}" alt="WAIT">
            @endif
        </div>
        <div>恋愛可能性: {{ $diagnosisContent['恋愛可能性'] }}</div>
        <div>GOorWAIT: {{ $diagnosisContent['GOorWAIT'] }}</div>
        <div>診断結果: {{ $diagnosisContent['診断結果'] }}</div>

    @else
        <div>No diagnosis available</div>
    @endif
  </div>
</body>
</html>
