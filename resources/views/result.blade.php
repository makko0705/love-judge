<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>診断結果</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <nav>
    <a href="{{ url('/') }}">診断する</a>
    <a href="{{ url('/history') }}">過去のデータ</a>
  </nav>
  <div class="container">
    <div id="imageArea">
      <img id="resultImage" src="" alt="結果画像" style="display: none;">
    </div>
    <div id="compatibilityArea"></div>
    <textarea id="diagnosisResponse" rows="10" readonly></textarea>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
        const diagnosisResponse = sessionStorage.getItem('diagnosisResponse');
        const partnerName = sessionStorage.getItem('partnerName');
        if (!diagnosisResponse || !partnerName) {
            console.error('No diagnosis response or partner name found in session storage.');
            return;
        }
        console.log('Diagnosis Response:', diagnosisResponse); // Debug
        console.log('Partner Name:', partnerName); // Debug

        const parsedResponse = JSON.parse(diagnosisResponse);
        const diagnosisObject = JSON.parse(parsedResponse.choices[0].message.content);
        console.log('Diagnosis Object:', diagnosisObject); // Debug

        const compatibilityArea = document.getElementById('compatibilityArea');
        const resultImage = document.getElementById('resultImage');
        const diagnosisText = diagnosisObject.診断結果;
        const compatibilityPercentage = parseInt(diagnosisObject.恋愛可能性.replace('%', ''));
        const goOrWait = diagnosisObject.GOorWAIT;

        document.getElementById('diagnosisResponse').textContent = diagnosisText;
        compatibilityArea.textContent = `${partnerName}さんとの恋愛可能性: ${compatibilityPercentage}%`;

        if (goOrWait === "GO") {
            resultImage.src = '{{ asset("images/GO!.png") }}';
        } else {
            resultImage.src = '{{ asset("images/WAIT!.png") }}';
        }
        resultImage.style.display = 'block';

        const userName = sessionStorage.getItem('userName');
        const diagnosisData = {
            userName: userName,
            diagnosis: diagnosisResponse
        };

        const history = JSON.parse(localStorage.getItem('history')) || [];
        history.push(diagnosisData);
        localStorage.setItem('history', JSON.stringify(history));
    });
  </script>
</body>
</html>
