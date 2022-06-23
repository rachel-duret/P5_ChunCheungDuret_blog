<?php
declare (strict_types = 1);
namespace app\models\validation;

use app\models\validation\ErrorModel;

class RegisterModel extends ErrorModel
{
    public string $username;
    public string $email;
    public string $password;
    public string $confirmPassword;

    public function rules()
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],

        ];
    }

}