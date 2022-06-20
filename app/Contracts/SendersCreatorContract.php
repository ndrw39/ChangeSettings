<?php

namespace App\Contracts;

interface SendersCreatorContract
{
    public static function make(string $sender): SendersContract;
}