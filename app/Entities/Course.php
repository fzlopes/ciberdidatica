<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Course extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name', 'description', 'value', 'evaluation', 'tag_id', 'module_id', 'teacher_id', 'student_id'];

}
