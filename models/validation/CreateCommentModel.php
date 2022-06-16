<?php

namespace app\models\validation;

use app\models\validation\ErrorModel;

class CreateCommentModel extends ErrorModel
{

    public $comment;

    public function rules()
    {
        return [
            'comment' => [self::RULE_REQUIRED],

        ];
    }
}