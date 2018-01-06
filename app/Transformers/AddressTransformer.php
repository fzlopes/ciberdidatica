<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Address;

/**
 * Class AddressTransformer
 * @package namespace App\Transformers;
 */
class AddressTransformer extends TransformerAbstract
{

    /**
     * Transform the Address entity
     * @param App\Entities\Address $model
     *
     * @return array
     */
    public function transform(Address $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
