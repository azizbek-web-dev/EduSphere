<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramBotController;

// Telegram Bot Routes
Route::post('/telegram/webhook', [TelegramBotController::class, 'webhook']);
Route::get('/telegram/set-webhook', [TelegramBotController::class, 'setWebhook']);
Route::get('/telegram/webhook-info', [TelegramBotController::class, 'getWebhookInfo']);
