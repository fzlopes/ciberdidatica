<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class StateValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'acronym' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'acronym' => 'required',
        ],
    ];
}
