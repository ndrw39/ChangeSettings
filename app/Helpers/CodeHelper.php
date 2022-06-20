<?php

namespace App\Helpers;

class CodeHelper
{
    public static function generate(int $user_id): int
    {
        // Здесь должна быть менее примитивная реализация
        $code = random_int(100000, 999999);
        $_SESSION['code'][$user_id] = $code;
        return $code;
    }

    public static function validate(int $user_id, int $code): bool
    {
        if (!isset($_SESSION['code'][$user_id])) {
            return false;
        }

        return $_SESSION['code'][$user_id] === $code;
    }

    public static function unsetCode(int $user_id): void
    {
        if (!isset($_SESSION['code'][$user_id])) {
            return;
        }

        unset($_SESSION['code'][$user_id]);
    }
}