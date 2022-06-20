<?php

namespace App\Services\SendersFactory\Senders;

use App\Contracts\SendersContract;

abstract class AbstractSender implements SendersContract
{
    private array $errors = [];
    public abstract function sendCode(object $user): bool;

    public function getErrors(): array
    {
        return $this->errors;
    }
}