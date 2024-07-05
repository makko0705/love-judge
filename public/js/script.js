document.addEventListener('DOMContentLoaded', async () => {
    if (window.location.pathname.endsWith('/progress')) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('CSRF token not found in the document.');
            return;
        }

        const chatHistory = sessionStorage.getItem('chatHistory');
        const userName = sessionStorage.getItem('userName');
        const progressBar = document.getElementById('progressBar');
        const progressElement = document.getElementById('progress');

        if (!chatHistory || !userName || !progressBar || !progressElement) {
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
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                },
                body: JSON.stringify({ chatHistory: chatHistory, userName: userName })
            });

            if (!response.ok) {
                const errorResponse = await response.json();
                throw new Error(`HTTP error! status: ${response.status}, message: ${JSON.stringify(errorResponse)}`);
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

            // ここでエラーメッセージを適切に表示します
            if (error instanceof Error) {
                progressElement.textContent = `Error: ${error.message}`;
            } else {
                progressElement.textContent = `Error: ${JSON.stringify(error)}`;
            }
        }
    }
});
