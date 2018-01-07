<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Module extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name', 'class_id'];

}
