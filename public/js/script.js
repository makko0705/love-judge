document.addEventListener('DOMContentLoaded', async () => {
    if (window.location.pathname.endsWith('/progress')) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const chatHistory = sessionStorage.getItem('chatHistory');
        const userName = sessionStorage.getItem('userName');
        const fileName = sessionStorage.getItem('fileName'); // ファイル名を取得
        const progressBar = document.getElementById('progressBar');
        const progressElement = document.getElementById('progress');

        if (!chatHistory || !userName || !fileName || !progressBar || !progressElement || !csrfToken) {
            console.error('Required elements or session data not found.');
            return;
        }

        const fetchWithRetry = async (url, options, retries = 5, delayTime = 30000) => {
            for (let i = 0; i < retries; i++) {
                const response = await fetch(url, options);
                if (response.status !== 429) {
                    return response;
                }
                const retryAfter = response.headers.get('Retry-After');
                const waitTime = retryAfter ? parseInt(retryAfter) * 1000 : delayTime;
                console.log(`429 Too Many Requests - Retrying after ${waitTime} ms`);
                await new Promise(resolve => setTimeout(resolve, waitTime));
            }
            throw new Error('Too many requests after multiple retries');
        };

        const updateProgressBar = (percentage) => {
            progressBar.style.width = `${percentage}%`;
            progressBar.textContent = `${percentage}%`;
            if (percentage > 0) {
                progressBar.style.color = 'white';
            }
        };

        try {
            progressElement.textContent = 'Processing...';
            updateProgressBar(25);

            const response = await fetchWithRetry('/analyze', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ chatHistory: chatHistory, userName: userName, fileName: fileName })
            });

            if (!response.ok) {
                throw new Error('API Request failed');
            }

            updateProgressBar(50);

            const result = await response.json();
            console.log('API Response:', result); // Debug: Log the API response
            if (result.error) {
                throw new Error(result.error);
            }

            updateProgressBar(75);

            sessionStorage.setItem('diagnosisResponse', JSON.stringify(result));
            progressElement.textContent = 'Processing complete.';
            updateProgressBar(100);

            window.location.href = '/result';
        } catch (error) {
            console.error('Error:', error);

            // エラーメッセージを非表示に設定
            const imageArea = document.getElementById('imageArea');
            const errorElement = document.querySelector('.error');
            if (imageArea) {
                imageArea.style.display = 'none';
            }
            if (errorElement) {
                errorElement.style.display = 'block';
            }
        }
    }
});
