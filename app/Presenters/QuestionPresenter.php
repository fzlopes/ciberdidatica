<?php

namespace App\Presenters;

use App\Transformers\QuestionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class QuestionPresenter
 *
 * @package namespace App\Presenters;
 */
class QuestionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new QuestionTransformer();
    }
}
