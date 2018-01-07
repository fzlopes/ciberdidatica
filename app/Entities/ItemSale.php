<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ItemSale extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['unitary_value', 'promotion_id', 'sale_id', 'course_id'];

}
