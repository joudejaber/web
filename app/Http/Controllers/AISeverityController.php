<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AISeverityController extends Controller
{
    public function estimate(Request $request)
    {
        $description = $request->input('description');

        if (!$description) {
            return response()->json(['error' => 'Description is required'], 400);
        }

        $prompt = "Classify the damage severity in this description as 'minor', 'moderate', or 'severe'.
        Only respond with one word.\n\nDescription: {$description}";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.3,
            'max_tokens' => 10,
        ]);

        $result = strtolower(trim($response['choices'][0]['message']['content'] ?? ''));

        if (!in_array($result, ['minor', 'moderate', 'severe'])) {
            $result = 'moderate'; // fallback
        }

        return response()->json(['severity' => $result]);
    }
}
