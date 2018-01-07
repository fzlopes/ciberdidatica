<?php

namespace App\Presenters;

use App\Transformers\AnswerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AnswerPresenter
 *
 * @package namespace App\Presenters;
 */
class AnswerPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AnswerTransformer();
    }
}
