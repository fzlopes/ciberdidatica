<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\People;

/**
 * Class PeopleTransformer
 * @package namespace App\Transformers;
 */
class PeopleTransformer extends TransformerAbstract
{

    /**
     * Transform the People entity
     * @param App\Entities\People $model
     *
     * @return array
     */
    public function transform(People $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
