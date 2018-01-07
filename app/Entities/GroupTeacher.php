<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class GroupTeacher extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['group_id', 'teacher_id'];

}
