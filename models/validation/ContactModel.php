<?php

namespace app\models\validation;

use app\models\validation\ErrorModel;

class ContactModel extends ErrorModel
{
    public $first_name;
    public $last_name;
    public $email;
    public $message;

    public function rules()
    {
        return [
            'first_name' => [self::RULE_REQUIRED],
            'last_name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'message' => [self::RULE_REQUIRED],

        ];
    }

}