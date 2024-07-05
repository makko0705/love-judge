<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>過去のデータ</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        const consultations = @json($consultations);

        consultations.forEach((consultation) => {
            const entryDiv = document.createElement('div');
            entryDiv.classList.add('history-entry');

            const diagnosis = consultation.diagnoses.length > 0 ? consultation.diagnoses[0] : null;
            const diagnosisContent = diagnosis ? JSON.parse(diagnosis.diagnosis_content) : {};

            const nameDiv = document.createElement('div');
            nameDiv.innerHTML = `<a href="/detail/${consultation.id}">${consultation.partner_name}</a>`;
            entryDiv.appendChild(nameDiv);

            const percentageDiv = document.createElement('div');
            percentageDiv.textContent = diagnosisContent['恋愛可能性'];
            entryDiv.appendChild(percentageDiv);

            const goOrWaitDiv = document.createElement('div');
            goOrWaitDiv.textContent = diagnosisContent['GOorWAIT'];
            entryDiv.appendChild(goOrWaitDiv);

            const deleteButton = document.createElement('button');
            deleteButton.textContent = '削除';
            deleteButton.addEventListener('click', async () => {
                try {
                    const response = await fetch(`/delete-consultation/${consultation.id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });

                    if (response.ok) {
                        entryDiv.remove();
                    } else {
                        console.error('Failed to delete consultation');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
            entryDiv.appendChild(deleteButton);

            historyList.appendChild(entryDiv);
        });
    });
  </script>
</body>
</html>
