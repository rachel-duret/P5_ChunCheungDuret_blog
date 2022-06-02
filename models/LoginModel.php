<?php

namespace app\models;

use app\models\ErrorModel;

class LoginModel extends ErrorModel
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

}