<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PromotionRepository;
use App\Entities\Promotion;
use App\Validators\PromotionValidator;

/**
 * Class PromotionRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PromotionRepositoryEloquent extends BaseRepository implements PromotionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Promotion::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PromotionValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
