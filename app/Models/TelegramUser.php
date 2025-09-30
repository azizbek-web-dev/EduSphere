<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    protected $fillable = [
        'telegram_id',
        'first_name',
        'last_name',
        'username',
        'language_code',
        'is_bot',
        'last_activity',
    ];

    protected $casts = [
        'is_bot' => 'boolean',
        'last_activity' => 'datetime',
    ];
}
