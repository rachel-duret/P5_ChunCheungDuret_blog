<?php

namespace app\models\validation;

use app\models\validation\ErrorModel;

class AdminModel extends ErrorModel
{
    public $username;
    public $profession;
    public $skil;
    

    public function rules()
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'profession' => [self::RULE_REQUIRED],
            'skill' => [self::RULE_REQUIRED],
        ];
    }

}