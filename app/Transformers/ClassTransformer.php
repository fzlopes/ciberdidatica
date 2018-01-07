<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Class;

/**
 * Class ClassTransformer
 * @package namespace App\Transformers;
 */
class ClassTransformer extends TransformerAbstract
{

    /**
     * Transform the Class entity
     * @param App\Entities\Class $model
     *
     * @return array
     */
    public function transform(Class $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
