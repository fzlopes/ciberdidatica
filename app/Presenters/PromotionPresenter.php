<?php

namespace App\Presenters;

use App\Transformers\PromotionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PromotionPresenter
 *
 * @package namespace App\Presenters;
 */
class PromotionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PromotionTransformer();
    }
}
