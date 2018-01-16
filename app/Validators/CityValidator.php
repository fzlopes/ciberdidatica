<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CityValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'name' => 'required',
        	'state_id' => 'required|exists:states,id',
        	
        ],

        ValidatorInterface::RULE_UPDATE => [
        	'name' => 'required',
        	'state_id' => 'required|exists:states,id',

        ],
    ];
}
