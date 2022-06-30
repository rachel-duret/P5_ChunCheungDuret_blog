<?php
declare (strict_types = 1);
namespace app\models\validation;

use app\models\validation\ErrorModel;

class ContactModel extends ErrorModel
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $message;

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
