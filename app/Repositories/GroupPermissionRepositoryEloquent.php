<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GroupPermissionRepository;
use App\Entities\GroupPermission;
use App\Validators\GroupPermissionValidator;

/**
 * Class GroupPermissionRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GroupPermissionRepositoryEloquent extends BaseRepository implements GroupPermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GroupPermission::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return GroupPermissionValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
