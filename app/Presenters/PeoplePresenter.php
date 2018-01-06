<?php

namespace App\Presenters;

use App\Transformers\PeopleTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PeoplePresenter
 *
 * @package namespace App\Presenters;
 */
class PeoplePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PeopleTransformer();
    }
}
