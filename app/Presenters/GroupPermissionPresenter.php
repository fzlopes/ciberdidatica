<?php

namespace App\Presenters;

use App\Transformers\GroupPermissionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class GroupPermissionPresenter
 *
 * @package namespace App\Presenters;
 */
class GroupPermissionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GroupPermissionTransformer();
    }
}
