<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AdressRepository;
use App\Entities\Adress;
use App\Validators\AdressValidator;

/**
 * Class AdressRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AdressRepositoryEloquent extends BaseRepository implements AdressRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Adress::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AdressValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
