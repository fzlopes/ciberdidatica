<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GroupTeacherRepository;
use App\Entities\GroupTeacher;
use App\Validators\GroupTeacherValidator;

/**
 * Class GroupTeacherRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GroupTeacherRepositoryEloquent extends BaseRepository implements GroupTeacherRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GroupTeacher::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return GroupTeacherValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
