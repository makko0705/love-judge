<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Consultation;
use App\Models\Diagnosis;

class ChatController extends Controller
{
    private $apiKeys;
    private $apiEndpoint;

    public function __construct()
    {
        $this->apiKeys = [
            env('OPENAI_API_KEY1'),
            env('OPENAI_API_KEY2'),
            env('OPENAI_API_KEY3'),
            env('OPENAI_API_KEY4'),
            env('OPENAI_API_KEY5'),
            env('OPENAI_API_KEY6')
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
        $consultations = Consultation::with('diagnoses')->get();
        return view('history', compact('consultations'));
    }

    public function detail($id)
    {
        $consultation = Consultation::with('diagnoses')->findOrFail($id);
        return view('detail', compact('consultation'));
    }

    public function analyze(Request $request)
    {
        $chatHistory = $request->input('chatHistory');
        $userName = $request->input('userName');
        $partnerName = $this->findPartnerName($chatHistory, $userName);

        Log::info('Received userName: ' . $userName);
        Log::info('Determined partnerName: ' . $partnerName);

        if (!$partnerName) {
            return response()->json(['error' => 'Partner name not found in chat history'], 400);
        }

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
            $response = $this->fetchWithRetry($data);
            $responseBody = $response->body();
            Log::info('API Response Body: ' . $responseBody);

            $result = json_decode($responseBody, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Failed to parse JSON response: ' . json_last_error_msg());
            }

            $diagnosisContent = $result['choices'][0]['message']['content'];
            $diagnosisObject = json_decode($diagnosisContent, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Failed to parse diagnosis content: ' . json_last_error_msg());
            }

            // Check if the diagnosisObject contains all required keys
            if (!isset($diagnosisObject['恋愛可能性']) || !isset($diagnosisObject['GOorWAIT']) || !isset($diagnosisObject['診断結果'])) {
                throw new \Exception('Invalid JSON format in diagnosis content: Missing required keys.');
            }

            $consultation = new Consultation();
            $consultation->user_name = $userName;
            $consultation->partner_name = $partnerName;
            $consultation->save();

            $diagnosis = new Diagnosis();
            $diagnosis->consultation_id = $consultation->id;
            $diagnosis->diagnosis_content = json_encode($diagnosisObject, JSON_UNESCAPED_UNICODE);
            $diagnosis->love_possibility = intval($diagnosisObject['恋愛可能性']);
            $diagnosis->go_or_wait = $diagnosisObject['GOorWAIT'];
            $diagnosis->save();

            return response()->json($result);
        } catch (\Exception $e) {
            Log::error('API Request failed: ' . $e->getMessage());
            if (isset($responseBody)) {
                Log::error('Response Body: ' . $responseBody);
            }
            return response()->json(['error' => 'API Request failed', 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteConsultation($id)
    {
        $consultation = Consultation::with('diagnoses')->findOrFail($id);
        $consultation->diagnoses()->delete();
        $consultation->delete();
        return response()->json(['success' => true]);
    }

    public function getLatestConsultation()
    {
        $consultation = Consultation::with('diagnoses')->latest()->first();
        return response()->json($consultation);
    }

    private function fetchWithRetry($data, $retries = 5, $delayTime = 30000)
    {
        for ($i = 0; $i < $retries; $i++) {
            $apiKey = $this->apiKeys[$i % count($this->apiKeys)];
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$apiKey}",
            ])->post($this->apiEndpoint, $data);

            if ($response->status() !== 429) {
                return $response;
            }

            $retryAfter = $response->header('Retry-After');
            $waitTime = $retryAfter ? (int)$retryAfter * 1000 : $delayTime;
            usleep($waitTime * 1000);
        }

        throw new \Exception('Too many requests after multiple retries');
    }

    private function findPartnerName($chatHistory, $userName)
    {
        $lines = explode("\n", $chatHistory);
        $userNames = [];
        $partnerNames = [];

        foreach ($lines as $line) {
            $parts = explode("\t", $line);
            if (count($parts) >= 2) {
                $name = $parts[1];
                if ($name === $userName) {
                    $userNames[] = $name;
                } else {
                    $partnerNames[] = $name;
                }
            }
        }

        return !empty($partnerNames) ? $partnerNames[0] : null;
    }
}
