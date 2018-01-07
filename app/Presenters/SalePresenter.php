<?php

namespace App\Presenters;

use App\Transformers\SaleTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SalePresenter
 *
 * @package namespace App\Presenters;
 */
class SalePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SaleTransformer();
    }
}
