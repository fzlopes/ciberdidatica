<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GroupTeacherCreateRequest;
use App\Http\Requests\GroupTeacherUpdateRequest;
use App\Repositories\GroupTeacherRepository;
use App\Validators\GroupTeacherValidator;


class GroupTeachersController extends Controller
{

    /**
     * @var GroupTeacherRepository
     */
    protected $repository;

    /**
     * @var GroupTeacherValidator
     */
    protected $validator;

    public function __construct(GroupTeacherRepository $repository, GroupTeacherValidator $validator)
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
        $groupTeachers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $groupTeachers,
            ]);
        }

        return view('groupTeachers.index', compact('groupTeachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupTeacherCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GroupTeacherCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $groupTeacher = $this->repository->create($request->all());

            $response = [
                'message' => 'GroupTeacher created.',
                'data'    => $groupTeacher->toArray(),
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
        $groupTeacher = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $groupTeacher,
            ]);
        }

        return view('groupTeachers.show', compact('groupTeacher'));
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

        $groupTeacher = $this->repository->find($id);

        return view('groupTeachers.edit', compact('groupTeacher'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  GroupTeacherUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(GroupTeacherUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $groupTeacher = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'GroupTeacher updated.',
                'data'    => $groupTeacher->toArray(),
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
                'message' => 'GroupTeacher deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'GroupTeacher deleted.');
    }
}
