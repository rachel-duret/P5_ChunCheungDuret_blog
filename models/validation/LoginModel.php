<?php
declare (strict_types = 1);
namespace app\models\validation;

use app\models\validation\ErrorModel;

class LoginModel extends ErrorModel
{
    public string  $email;
    public string  $password;

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

}