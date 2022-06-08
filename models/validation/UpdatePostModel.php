<?php

namespace app\models\validation;

use app\models\validation\ErrorModel;

class UpdatePostModel extends ErrorModel
{
    public $title;
    public $subtitle;
    public $content;

    public function rules()
    {
        return [
            'title' => [self::RULE_REQUIRED],
            'subtitle' => [self::RULE_REQUIRED],
            'content' => [self::RULE_REQUIRED],

        ];
    }
}