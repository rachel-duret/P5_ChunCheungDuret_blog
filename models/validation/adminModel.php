<?php
declare (strict_types = 1);
namespace app\models\validation;

use app\models\validation\ErrorModel;

class AdminModel extends ErrorModel
{
    public string  $username;
    public string  $profession;
    public string  $skil;
    

    public function rules()
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'profession' => [self::RULE_REQUIRED],
            'skill' => [self::RULE_REQUIRED],
        ];
    }

}