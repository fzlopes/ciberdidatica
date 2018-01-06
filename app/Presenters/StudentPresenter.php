<?php

namespace App\Presenters;

use App\Transformers\StudentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StudentPresenter
 *
 * @package namespace App\Presenters;
 */
class StudentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StudentTransformer();
    }
}
