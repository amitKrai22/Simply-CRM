<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OllamaService
{
    public function ask(string $prompt): string
    {
        $response = Http::post('http://localhost:11434/api/generate', [
            'model' => 'llama3', // or whatever model you've loaded
            'prompt' => $prompt,
            'stream' => false,
        ]);

        return $response->json('response') ?? 'No suggestion available.';
    }
}
