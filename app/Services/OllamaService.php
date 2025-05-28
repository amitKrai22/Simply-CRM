<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class OllamaService
{
    public function ask(string $prompt): string
    {
        try {
            $response = Http::timeout(60) // increase timeout
                ->post('http://localhost:11434/api/generate', [
                    'model' => 'llama3.2',
                    'prompt' => $prompt,
                    'stream' => false,
                ]);

            if ($response->failed()) {
                return "❌ Ollama API failed with status: " . $response->status();
            }

            return $response->json('response') ?? 'No response from LLM.';
        } catch (\Exception $e) {
            return "❌ Exception: " . $e->getMessage();
        }
    }
}
