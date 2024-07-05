@extends('layouts.app')

@section('title', '過去のデータ')

@section('content')
    <h1>過去のデータ</h1>
    <div id="historyList"></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const historyList = document.getElementById('historyList');
            const history = @json($consultations);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // CSRFトークンを取得

            history.forEach(entry => {
                const entryDiv = document.createElement('div');
                entryDiv.classList.add('history-entry');

                const diagnosis = JSON.parse(entry.diagnoses[0].diagnosis_content);
                const partnerName = entry.partner_name;

                const nameDiv = document.createElement('div');
                nameDiv.classList.add('history-partner-name');
                nameDiv.innerHTML = `<a href="{{ url('/detail') }}/${entry.id}">${partnerName}</a>`;
                entryDiv.appendChild(nameDiv);

                const percentageDiv = document.createElement('div');
                percentageDiv.classList.add('history-percentage');
                percentageDiv.textContent = `${diagnosis['恋愛可能性']}`;
                entryDiv.appendChild(percentageDiv);

                const goOrWaitDiv = document.createElement('div');
                goOrWaitDiv.classList.add('history-go-or-wait');
                goOrWaitDiv.textContent = `${diagnosis['GOorWAIT']}`;
                entryDiv.appendChild(goOrWaitDiv);

                const deleteButton = document.createElement('button');
                deleteButton.classList.add('history-delete-button');
                deleteButton.textContent = '削除';
                deleteButton.addEventListener('click', async () => {
                    const response = await fetch(`{{ url('/delete-consultation') }}/${entry.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // CSRFトークンをヘッダーに追加
                        }
                    });
                    if (response.ok) {
                        location.reload();
                    } else {
                        console.error('Failed to delete consultation');
                    }
                });
                entryDiv.appendChild(deleteButton);

                historyList.appendChild(entryDiv);
            });
        });
    </script>
@endsection
