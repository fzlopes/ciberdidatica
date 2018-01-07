<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AnswerRepository;
use App\Entities\Answer;
use App\Validators\AnswerValidator;

/**
 * Class AnswerRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AnswerRepositoryEloquent extends BaseRepository implements AnswerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Answer::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AnswerValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
