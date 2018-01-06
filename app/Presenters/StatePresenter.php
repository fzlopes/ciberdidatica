<?php

namespace App\Presenters;

use App\Transformers\StateTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StatePresenter
 *
 * @package namespace App\Presenters;
 */
class StatePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StateTransformer();
    }
}
