<?php
declare (strict_types = 1);
namespace app\models\validation;

use app\models\validation\ErrorModel;

class CreateCommentModel extends ErrorModel
{

    public string $comment;

    public function rules()
    {
        return [
            'comment' => [self::RULE_REQUIRED],

        ];
    }
}