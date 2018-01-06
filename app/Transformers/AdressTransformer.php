<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Adress;

/**
 * Class AdressTransformer
 * @package namespace App\Transformers;
 */
class AdressTransformer extends TransformerAbstract
{

    /**
     * Transform the Adress entity
     * @param App\Entities\Adress $model
     *
     * @return array
     */
    public function transform(Adress $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
