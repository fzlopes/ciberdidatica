<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Promotion;

/**
 * Class PromotionTransformer
 * @package namespace App\Transformers;
 */
class PromotionTransformer extends TransformerAbstract
{

    /**
     * Transform the Promotion entity
     * @param App\Entities\Promotion $model
     *
     * @return array
     */
    public function transform(Promotion $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
