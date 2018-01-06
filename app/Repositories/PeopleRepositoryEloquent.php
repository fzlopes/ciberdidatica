<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PeopleRepository;
use App\Entities\People;
use App\Validators\PeopleValidator;

/**
 * Class PeopleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PeopleRepositoryEloquent extends BaseRepository implements PeopleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return People::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PeopleValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
