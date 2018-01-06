<?php

namespace App\Presenters;

use App\Transformers\TeacherTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TeacherPresenter
 *
 * @package namespace App\Presenters;
 */
class TeacherPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TeacherTransformer();
    }
}
