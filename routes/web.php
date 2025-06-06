<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskSuggestionController;
use App\Http\Controllers\AiAssistantController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('home')
        : redirect()->route('login.form');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
// require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('contacts', ContactController::class)->except(['show']);
});

Route::middleware('auth')->group(function () {
    Route::resource('leads', LeadController::class)->except(['show']);
});

Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class)->except(['show']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-panel', function () {
        return 'Only visible to Admins';
    });
});

Route::get('/contacts/export', [ContactController::class, 'export'])->name('contacts.export');


Route::get('/ai/task-suggestion', [TaskSuggestionController::class, 'suggest'])->name('ai.task.suggest');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

Route::get('/ai/assistant', [AiAssistantController::class, 'show'])->name('ai.assistant');
Route::post('/ai/assistant/ask', [AiAssistantController::class, 'ask'])->name('ai.assistant.ask');