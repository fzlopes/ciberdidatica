<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\GroupTeacher;

/**
 * Class GroupTeacherTransformer
 * @package namespace App\Transformers;
 */
class GroupTeacherTransformer extends TransformerAbstract
{

    /**
     * Transform the GroupTeacher entity
     * @param App\Entities\GroupTeacher $model
     *
     * @return array
     */
    public function transform(GroupTeacher $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
