<?php

namespace App\Presenters;

use App\Transformers\ClassTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ClassPresenter
 *
 * @package namespace App\Presenters;
 */
class ClassPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ClassTransformer();
    }
}
