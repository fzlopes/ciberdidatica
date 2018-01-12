<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Student extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['registration', 'first_name', 'last_name', 'email', 	'password', 'phone', 'cellphone', 'cep', 'public_place', 'number', 'complement', 'birth_of_date' 'cpf', 'city_id'];

}
