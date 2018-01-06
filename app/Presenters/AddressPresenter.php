<?php

namespace App\Presenters;

use App\Transformers\AddressTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AddressPresenter
 *
 * @package namespace App\Presenters;
 */
class AddressPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AddressTransformer();
    }
}
