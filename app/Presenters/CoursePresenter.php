<?php

namespace App\Presenters;

use App\Transformers\CourseTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CoursePresenter
 *
 * @package namespace App\Presenters;
 */
class CoursePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CourseTransformer();
    }
}
