<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\GroupPermission;

/**
 * Class GroupPermissionTransformer
 * @package namespace App\Transformers;
 */
class GroupPermissionTransformer extends TransformerAbstract
{

    /**
     * Transform the GroupPermission entity
     * @param App\Entities\GroupPermission $model
     *
     * @return array
     */
    public function transform(GroupPermission $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
