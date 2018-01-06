<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Student;

/**
 * Class StudentTransformer
 * @package namespace App\Transformers;
 */
class StudentTransformer extends TransformerAbstract
{

    /**
     * Transform the Student entity
     * @param App\Entities\Student $model
     *
     * @return array
     */
    public function transform(Student $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
