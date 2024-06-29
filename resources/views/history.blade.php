<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>過去のデータ</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <nav>
    <a href="{{ url('/') }}">診断する</a>
    <a href="{{ url('/history') }}">過去のデータ</a>
  </nav>
  <div class="container">
    <h1>過去のデータ</h1>
    <div id="historyList"></div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
        const historyList = document.getElementById('historyList');
        const history = JSON.parse(localStorage.getItem('history')) || [];

        history.forEach((entry, index) => {
            const entryDiv = document.createElement('div');
            entryDiv.classList.add('history-entry');

            const diagnosis = JSON.parse(entry.diagnosis);
            const partnerName = diagnosis.partnerName;

            const nameDiv = document.createElement('div');
            nameDiv.textContent = `${partnerName} さんの診断結果`;
            entryDiv.appendChild(nameDiv);

            const deleteButton = document.createElement('button');
            deleteButton.textContent = '削除';
            deleteButton.addEventListener('click', () => {
                history.splice(index, 1);
                localStorage.setItem('history', JSON.stringify(history));
                location.reload();
            });
            entryDiv.appendChild(deleteButton);

            const detailsButton = document.createElement('button');
            detailsButton.textContent = '詳細';
            detailsButton.addEventListener('click', () => {
                alert(JSON.stringify(entry.diagnosis, null, 2));
            });
            entryDiv.appendChild(detailsButton);

            historyList.appendChild(entryDiv);
        });
    });
  </script>
</body>
</html>
