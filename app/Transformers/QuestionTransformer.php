<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Question;

/**
 * Class QuestionTransformer
 * @package namespace App\Transformers;
 */
class QuestionTransformer extends TransformerAbstract
{

    /**
     * Transform the Question entity
     * @param App\Entities\Question $model
     *
     * @return array
     */
    public function transform(Question $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
