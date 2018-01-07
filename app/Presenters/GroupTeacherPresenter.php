<?php

namespace App\Presenters;

use App\Transformers\GroupTeacherTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class GroupTeacherPresenter
 *
 * @package namespace App\Presenters;
 */
class GroupTeacherPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GroupTeacherTransformer();
    }
}
