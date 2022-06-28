<?php
declare (strict_types = 1);
namespace app\models\validation;

use app\models\validation\ErrorModel;

class UpdatePostModel extends ErrorModel
{
    public string $title;
    public string $subtitle;
    public string $content;

    public function rules()
    {
        return [
            'title' => [self::RULE_REQUIRED],
            'subtitle' => [self::RULE_REQUIRED],
            'content' => [self::RULE_REQUIRED],

        ];
    }
}
