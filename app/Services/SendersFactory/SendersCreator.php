<?php

namespace App\Services\SendersFactory;

use App\Contracts\SendersContract;
use App\Contracts\SendersCreatorContract;
use App\Services\SendersFactory\Senders\Email;
use App\Services\SendersFactory\Senders\Sms;
use App\Services\SendersFactory\Senders\Telegram;

class SendersCreator implements SendersCreatorContract
{
    /**
     * @throws \Exception
     */
    public static function make(string $sender): SendersContract
    {
        return match ($sender) {
            'email' => new Email(),
            'sms' => new Sms(),
            'telegram' => new Telegram(),
            default => throw new \Exception('Unsupported sender'),
        };
    }
}