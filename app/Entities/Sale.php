<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Sale extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['creation_date', 'descont_value', 'total_value', 'status', 'observation', 'date_hour_delivery', 'student_id'];

}
