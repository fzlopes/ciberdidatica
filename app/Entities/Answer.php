<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Answer extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['answer'];

}
