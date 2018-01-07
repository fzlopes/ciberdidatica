<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GroupPermissionCreateRequest;
use App\Http\Requests\GroupPermissionUpdateRequest;
use App\Repositories\GroupPermissionRepository;
use App\Validators\GroupPermissionValidator;


class GroupPermissionsController extends Controller
{

    /**
     * @var GroupPermissionRepository
     */
    protected $repository;

    /**
     * @var GroupPermissionValidator
     */
    protected $validator;

    public function __construct(GroupPermissionRepository $repository, GroupPermissionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $groupPermissions = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $groupPermissions,
            ]);
        }

        return view('groupPermissions.index', compact('groupPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupPermissionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GroupPermissionCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $groupPermission = $this->repository->create($request->all());

            $response = [
                'message' => 'GroupPermission created.',
                'data'    => $groupPermission->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $groupPermission = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $groupPermission,
            ]);
        }

        return view('groupPermissions.show', compact('groupPermission'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $groupPermission = $this->repository->find($id);

        return view('groupPermissions.edit', compact('groupPermission'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  GroupPermissionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(GroupPermissionUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $groupPermission = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'GroupPermission updated.',
                'data'    => $groupPermission->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'GroupPermission deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'GroupPermission deleted.');
    }
}
