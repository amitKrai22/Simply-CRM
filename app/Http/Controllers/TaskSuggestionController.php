<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\OllamaService;
use App\Models\Lead;
use Illuminate\Support\Str;

class TaskSuggestionController extends Controller
{
    public function suggest(OllamaService $ollama)
    {
        $user = Auth::user();
        $leads = Lead::where('user_id', $user->id)
             ->where('status', '!=', 'closed')
             ->whereDate('updated_at', '<', now()->subDays(3))
             ->get(['name', 'status', 'updated_at']);


        // Admin sees all leads, Agent sees only theirs
    // $leads = $user->role === 'admin'
    // ? Lead::where('status', '!=', 'closed')
    //       ->whereDate('updated_at', '<', now()->subDays(3))
    //       ->latest()
    //       ->take(3) // ✅ Limit to 5 leads
    //       ->get(['name', 'status', 'updated_at', 'user_id'])
    // : Lead::where('user_id', $user->id)
    //       ->where('status', '!=', 'closed')
    //       ->whereDate('updated_at', '<', now()->subDays(3))
    //       ->latest()
    //       ->take(3) // ✅ Limit to 5
    //       ->get(['name', 'status', 'updated_at']);


    if ($leads->isEmpty()) {
        $suggestion = "No stale leads found. Looks like everything is up to date!";
    } else {
        $leadSummary = $leads->map(function ($lead) {
            return "Lead: {$lead->name}, Status: {$lead->status}, Last Updated: {$lead->updated_at->format('Y-m-d')}";
        })->implode("\n");
    }

        $prompt = "Based on the following lead data, suggest some follow-up tasks:\n" . $leadSummary;

        $suggestion = $ollama->ask($prompt);

        $lines = collect(explode("\n", $suggestion))
    ->map(fn($line) => trim(Str::replace(['*', '-', '•'], '', $line)))
    ->filter()
    ->take(3);

        return view('ai.task_suggestion', [
    'suggestedTasks' => $lines, // not $suggestion anymore
]);
    }
}