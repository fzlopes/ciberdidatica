<?php

namespace App\Presenters;

use App\Transformers\ItemSaleTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ItemSalePresenter
 *
 * @package namespace App\Presenters;
 */
class ItemSalePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ItemSaleTransformer();
    }
}
