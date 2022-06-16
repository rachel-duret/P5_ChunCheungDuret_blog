<?php
namespace app\models\validation;

abstract class ErrorModel
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public $errors = [];

    public function getData($postData)
    {
        foreach ($postData as $key => $value) {
            $_SESSION['post_data'] = $postData;
            if (property_exists($this, $key)) {
                $this->{$key} = $value;

            }

        }
    }
    /* *************** */

    abstract public function rules();

    /* ************ */
    public function validateData()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            var_dump($value);
            foreach ($rules as $rule) {

                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0]; //[self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorRules($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorRules($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrorRules($attribute, self::RULE_MIN);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addErrorRules($attribute, self::RULE_MAX);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    var_dump($rule['match']);
                    $this->addErrorRules($attribute, self::RULE_MATCH);
                }

            }
        }
        return empty($this->errors);
    }

    /* ***************** */

    /* ****************** */

    public function addErrorRules($attribute, $rule)
    {
        $message = $this->errorMessage()[$rule] ?? '';
        $this->errors[$attribute][] = ucfirst($attribute) . ': -' . $message;

    }
    public function addError($attribute, $message)
    {
        $this->errors[$attribute][] = $message;
    }
/* *********************************************************************************** */

    public function errorMessage()
    {
        return [
            self::RULE_REQUIRED => 'This field is required !',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be 8',
            self::RULE_MAX => 'Max length of this field must be 24',
            self::RULE_MATCH => 'This field must be the same as password',

        ];
    }

}