<?php

namespace Gym\User\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidMobile implements Rule
{
    /**
     * Create a new rule instance.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Validate iranian mobile number.
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $paramsPatternMap = [
            'zero_code'    => '/^(00989){1}[0-9]{9}+$/',
            'plus'         => '/^(\+989){1}[0-9]{9}+$/',
            'code'         => '/^(989){1}[0-9]{9}+$/',
            'zero'         => '/^(09){1}[0-9]{9}+$/',
            'without_zero' => '/^(9){1}[0-9]{9}+$/',
        ];

        if (isset($parameters[0]) && in_array($parameters[0], array_keys($paramsPatternMap))) {
            return preg_match($paramsPatternMap[$parameters[0]], $value);
        }

        return (preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $value) || preg_match('/^(9){1}[0-9]{9}+$/', $value))? true : false;
    }


    /**
     * Get the validation error message.
     * @return string
     */
    public function message(): string
    {
        return 'فرمت موبایل نامعتبر است.';
    }
}
