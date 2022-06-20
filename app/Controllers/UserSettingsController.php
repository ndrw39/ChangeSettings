<?php

namespace App\Controllers;

use App\Helpers\CodeHelper;
use App\Services\SendersFactory\SendersCreator;


class UserSettingsController
{

    /**
     * @param object $request
     * @param object $user
     * @return array
     * @throws \Exception в $request попадают уже валидированные данные
     * в $user модель юзера
     * в моей архитектуре подразумевается связь один ко многим user -> user_settings
     * возвращает array, в реальных условиях json ответ
     */
    public function sendCode(object $request, object $user): array
    {
        $sender = SendersCreator::make($request->type);
        $result = ['success' => $sender->sendCode($user)];
        $errors = $sender->getErrors();

        if (!empty($errors)) {
            http_send_status(520);
            $result['errors'] = $errors;
        }

        return $result;
    }

    /**
     * @param object $request
     * @param object $user
     * @return array
     * в $request попадают уже валидированные данные
     */
    public function update(object $request, object $user): array
    {
        $valid = CodeHelper::validate($user->id, $request->code);

        if ($valid !== true) {
            return [
                'success' => false,
                'error' => 'Not valid code'
            ];
        }

        $userSettings = $user->getUserSettings()
            ->where('user_id', $user->id)
            ->where('name', $request->name)
            ->get();

        if (empty($userSettings)) {
            return [
                'success' => false,
                'error' => 'Not valid setting'
            ];
        }

        CodeHelper::unsetCode($user->id);

        $userSettings->update(['value' => $request->value]);

        return [
            'success' => true,
        ];
    }
}

