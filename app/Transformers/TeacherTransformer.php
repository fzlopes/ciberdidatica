<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Teacher;

/**
 * Class TeacherTransformer
 * @package namespace App\Transformers;
 */
class TeacherTransformer extends TransformerAbstract
{

    /**
     * Transform the Teacher entity
     * @param App\Entities\Teacher $model
     *
     * @return array
     */
    public function transform(Teacher $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
