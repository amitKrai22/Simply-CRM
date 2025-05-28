<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\OllamaService;
use App\Models\Lead;

class TaskSuggestionController extends Controller
{
    public function suggest(OllamaService $ollama)
    {
        $user = Auth::user();

        $leads = Lead::where('user_id', $user->id)
                     ->where('status', '!=', 'closed')
                     ->whereDate('updated_at', '<', now()->subDays(3))
                     ->get(['name', 'status', 'updated_at']);

        $leadSummary = $leads->map(function ($lead) {
            return "Lead: {$lead->name}, Status: {$lead->status}, Last Updated: {$lead->updated_at->format('Y-m-d')}";
        })->implode("\n");

        $prompt = "Based on the following lead data, suggest some follow-up tasks:\n" . $leadSummary;

        $suggestion = $ollama->ask($prompt);

        return view('ai.task_suggestion', compact('suggestion'));
    }
}