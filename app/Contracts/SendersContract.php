<?php

namespace App\Contracts;

interface SendersContract
{
    public function sendCode(object $user): bool;

    public function getErrors(): array;
}