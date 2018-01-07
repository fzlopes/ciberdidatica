<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Answer;

/**
 * Class AnswerTransformer
 * @package namespace App\Transformers;
 */
class AnswerTransformer extends TransformerAbstract
{

    /**
     * Transform the Answer entity
     * @param App\Entities\Answer $model
     *
     * @return array
     */
    public function transform(Answer $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
