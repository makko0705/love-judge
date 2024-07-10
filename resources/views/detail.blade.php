@extends('layouts.app')

@section('title', '診断詳細')

@section('content')
<div class="container page-detail">

    {{-- <h1>{{ $consultation->partner_name }} さんの診断詳細</h1> --}}
    @if ($consultation->diagnoses->isNotEmpty())
        @php
            $diagnosis = $consultation->diagnoses->first();
            $diagnosisContent = json_decode($diagnosis->diagnosis_content, true);
        @endphp
        <div id="imageArea">
            <img id="resultImage" src="{{ asset('images/' . ($diagnosisContent['GOorWAIT'] === 'GO' ? 'GO.png' : 'WAIT.png')) }}" alt="結果画像">
        </div>

        <div id="compatibilityArea">{{ $consultation->partner_name }}さんとの恋愛可能性: {{ $diagnosisContent['恋愛可能性'] }}</div>
        {{-- <div>GOorWAIT: {{ $diagnosisContent['GOorWAIT'] }}</div> --}}
        <div>{{ $diagnosisContent['診断結果'] }}</div>

    @else
        <div>No diagnosis available</div>
    @endif
</div>
@endsection
