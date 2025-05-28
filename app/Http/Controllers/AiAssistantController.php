<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OllamaService;

class AiAssistantController extends Controller
{
    public function show()
    {
        return view('ai.assistant');
    }

    public function ask(Request $request, OllamaService $ollama)
    {
        $request->validate(['prompt' => 'required|string|max:500']);
        $response = $ollama->ask($request->prompt);

        return back()->with('response', $response)->withInput();
    }
}

