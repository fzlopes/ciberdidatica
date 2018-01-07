<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Teacher extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'active', 'date_of_birth', 'telephone', 'cellphone', 'cep', 'public_place', 'number', 'complement', 'cpf' ];

}
