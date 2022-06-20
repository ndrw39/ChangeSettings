<?php

namespace App\Services\SendersFactory\Senders;

use App\Helpers\CodeHelper;

class Telegram extends AbstractSender
{
    public function sendCode(object $user): bool
    {
        $code = CodeHelper::generate($user->id);
        // Здесь должна быть логика отправки сообщения и получения данных юзера
        // Плюс я бы добавил прослойку для работы с сессиями
        // И запись в лог, если не ушло сообщение

        return true;
    }
}