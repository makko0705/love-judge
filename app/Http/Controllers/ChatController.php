<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    private $apiKeys;
    private $apiEndpoint;

    public function __construct()
    {
        $this->apiKeys = [
            env('OPENAI_API_KEY1'),
            env('OPENAI_API_KEY2'),
            env('OPENAI_API_KEY3')
        ];
        $this->apiEndpoint = 'https://api.openai.com/v1/chat/completions';
    }

    public function index()
    {
        return view('index');
    }

    public function progress()
    {
        return view('progress');
    }

    public function result()
    {
        return view('result');
    }

    public function history()
    {
        return view('history');
    }

    public function analyze(Request $request)
    {
        $chatHistory = $request->input('chatHistory');
        $apiKeyIndex = 0;
        $prompt = "以下のチャット履歴を分析し、診断結果を提供してください。診断内容を以下のJSON形式で返してください:\n" .
        "{\n" .
        "  \"恋愛可能性\": \"◯%\",\n" .
        "  \"GOorWAIT\": \"GO or WAIT\",\n" .
        "  \"診断結果\": \"テキストテキストテキストテキストテキストテキスト\"\n" .
        "}\n\n{$chatHistory}";

        $data = [
            'model' => 'gpt-4',
            'messages' => [['role' => 'user', 'content' => $prompt]],
        ];

        try {
            $response = $this->fetchWithRetry($data, $apiKeyIndex);
            Log::info('API Response: ', $response);
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('API Request failed: ' . $e->getMessage());
            $responseBody = isset($response) ? $response->body() : 'No response body';
            Log::error('Response body: ' . $responseBody);
            return response()->json(['error' => 'API Request failed', 'message' => $e->getMessage(), 'response' => $responseBody], 500);
        }
    }

    private function fetchWithRetry($data, &$apiKeyIndex, $retries = 5, $delayTime = 30000)
    {
        for ($i = 0; $i < $retries; $i++) {
            $apiKey = $this->apiKeys[$apiKeyIndex++ % count($this->apiKeys)];
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$apiKey}",
            ])->post($this->apiEndpoint, $data);

            if ($response->status() !== 429) {
                if ($response->ok()) {
                    Log::info('Successful response: ' . $response->body());
                } else {
                    Log::warning('Non-429 unsuccessful response: ' . $response->body());
                }
                return $response->json();
            }

            $retryAfter = $response->header('Retry-After');
            $waitTime = $retryAfter ? (int)$retryAfter * 1000 : $delayTime;
            usleep($waitTime * 1000);
        }

        throw new \Exception('Too many requests after multiple retries');
    }
}
