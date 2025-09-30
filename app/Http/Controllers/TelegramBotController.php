<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramBotController extends Controller
{
    private $botToken;
    private $apiUrl;

    public function __construct()
    {
        $this->botToken = env('TELEGRAM_BOT_TOKEN');
        $this->apiUrl = "https://api.telegram.org/bot{$this->botToken}/";
    }

    /**
     * Handle Telegram webhook
     */
    public function webhook(Request $request)
    {
        try {
            $update = $request->all();
            Log::info('Telegram Update:', $update);

            // Handle message
            if (isset($update['message'])) {
                $message = $update['message'];
                $chatId = $message['chat']['id'];
                $text = $message['text'] ?? '';

                // Handle /start command
                if ($text === '/start') {
                    $this->handleStart($message);
                }
            }

            return response()->json(['ok' => true]);
        } catch (\Exception $e) {
            Log::error('Telegram Webhook Error: ' . $e->getMessage());
            return response()->json(['ok' => false], 500);
        }
    }

    /**
     * Handle /start command
     */
    private function handleStart($message)
    {
        $user = $message['from'];
        $chatId = $message['chat']['id'];

        // Save or update user in database
        TelegramUser::updateOrCreate(
            ['telegram_id' => $user['id']],
            [
                'first_name' => $user['first_name'] ?? '',
                'last_name' => $user['last_name'] ?? null,
                'username' => $user['username'] ?? null,
                'language_code' => $user['language_code'] ?? null,
                'is_bot' => $user['is_bot'] ?? false,
                'last_activity' => now(),
            ]
        );

        // Prepare welcome message
        $welcomeText = "👋 Salom, " . ($user['first_name'] ?? 'Foydalanuvchi') . "!\n\n";
        $welcomeText .= "🎓 EduSphere ta'lim platformasiga xush kelibsiz!\n\n";
        $welcomeText .= "Bu yerda siz:\n";
        $welcomeText .= "✅ Kurslarni ko'rishingiz\n";
        $welcomeText .= "✅ Darslarni o'rganishingiz\n";
        $welcomeText .= "✅ Topshiriqlarni bajarishingiz mumkin\n\n";
        $welcomeText .= "Davom etish uchun quyidagi tugmalardan birini tanlang:";

        // Create inline keyboard
        $keyboard = [
            'inline_keyboard' => [
                [
                    [
                        'text' => '🌐 Web App ni ochish',
                        'web_app' => ['url' => env('APP_URL') . '/webapp']
                    ]
                ],
                [
                    [
                        'text' => '🤖 Bot haqida',
                        'callback_data' => 'about_bot'
                    ]
                ]
            ]
        ];

        $this->sendMessage($chatId, $welcomeText, $keyboard);
    }

    /**
     * Send message via Telegram API
     */
    private function sendMessage($chatId, $text, $keyboard = null)
    {
        $data = [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'HTML',
        ];

        if ($keyboard) {
            $data['reply_markup'] = json_encode($keyboard);
        }

        try {
            $response = Http::post($this->apiUrl . 'sendMessage', $data);
            return $response->json();
        } catch (\Exception $e) {
            Log::error('Send Message Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Set webhook URL
     */
    public function setWebhook()
    {
        $webhookUrl = env('APP_URL') . '/api/telegram/webhook';
        
        $response = Http::post($this->apiUrl . 'setWebhook', [
            'url' => $webhookUrl,
        ]);

        return response()->json($response->json());
    }

    /**
     * Get webhook info
     */
    public function getWebhookInfo()
    {
        $response = Http::get($this->apiUrl . 'getWebhookInfo');
        return response()->json($response->json());
    }
}