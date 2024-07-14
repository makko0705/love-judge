@extends('layouts.app')

@section('title', '診断結果')

@section('content')
<div class="container page-result">
    <h1><img src="images/h1_result.png" alt="診断結果"></h1>

    <div id="imageArea">
      <img id="resultImage" src="" alt="結果画像" style="display: none;">
    </div>
    <div id="compatibilityArea"></div>
    <textarea id="diagnosisResponse" rows="10" readonly></textarea>
    <div class="error" style="display:none;">
        <img id="errorImage" src="{{ asset('images/SORRY.png') }}" alt="エラー画像">
        <p>エラーが発生しました。しばらくしてからもう一度お試しください。</p>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            // 最新の診断結果をサーバーから取得
            const response = await fetch('{{ url('/latest-consultation') }}');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();

            const diagnosisContent = result.diagnoses[0].diagnosis_content;
            const diagnosisObject = JSON.parse(diagnosisContent);

            const compatibilityArea = document.getElementById('compatibilityArea');
            const resultImage = document.getElementById('resultImage');
            const diagnosisText = diagnosisObject.診断結果;
            const compatibilityPercentage = parseInt(diagnosisObject.恋愛可能性.replace('%', ''));
            const goOrWait = diagnosisObject.GOorWAIT;
            const partnerName = result.partner_name;

            document.getElementById('diagnosisResponse').textContent = diagnosisText;
            compatibilityArea.textContent = `${partnerName}さんとの恋愛可能性: ${compatibilityPercentage}%`;

            if (goOrWait === "GO") {
                resultImage.src = '{{ asset("images/GO.png") }}';
            } else {
                resultImage.src = '{{ asset("images/WAIT.png") }}';
            }
            resultImage.style.display = 'block';

        } catch (error) {
            console.error('Error:', error);
            document.getElementById('resultImage').src = '{{ asset('images/SORRY.png') }}';
            document.querySelector('.error').style.display = 'block';
        }
    });
</script>
@endsection
