<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ItemSaleRepository;
use App\Entities\ItemSale;
use App\Validators\ItemSaleValidator;

/**
 * Class ItemSaleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ItemSaleRepositoryEloquent extends BaseRepository implements ItemSaleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ItemSale::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ItemSaleValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
