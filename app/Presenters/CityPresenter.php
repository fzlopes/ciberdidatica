<?php

namespace App\Presenters;

use App\Transformers\CityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CityPresenter
 *
 * @package namespace App\Presenters;
 */
class CityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CityTransformer();
    }
}
