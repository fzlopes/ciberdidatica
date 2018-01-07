<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ItemSale;

/**
 * Class ItemSaleTransformer
 * @package namespace App\Transformers;
 */
class ItemSaleTransformer extends TransformerAbstract
{

    /**
     * Transform the ItemSale entity
     * @param App\Entities\ItemSale $model
     *
     * @return array
     */
    public function transform(ItemSale $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
