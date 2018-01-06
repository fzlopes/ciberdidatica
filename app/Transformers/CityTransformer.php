<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\City;

/**
 * Class CityTransformer
 * @package namespace App\Transformers;
 */
class CityTransformer extends TransformerAbstract
{

    /**
     * Transform the City entity
     * @param App\Entities\City $model
     *
     * @return array
     */
    public function transform(City $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
