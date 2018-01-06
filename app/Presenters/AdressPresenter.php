<?php

namespace App\Presenters;

use App\Transformers\AdressTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AdressPresenter
 *
 * @package namespace App\Presenters;
 */
class AdressPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdressTransformer();
    }
}
