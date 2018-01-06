<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TeacherCreateRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Repositories\TeacherRepository;
use App\Validators\TeacherValidator;


class TeachersController extends Controller
{

    /**
     * @var TeacherRepository
     */
    protected $repository;

    /**
     * @var TeacherValidator
     */
    protected $validator;

    public function __construct(TeacherRepository $repository, TeacherValidator $validator)
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
        $teachers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $teachers,
            ]);
        }

        return view('teachers.index', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TeacherCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $teacher = $this->repository->create($request->all());

            $response = [
                'message' => 'Teacher created.',
                'data'    => $teacher->toArray(),
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
        $teacher = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $teacher,
            ]);
        }

        return view('teachers.show', compact('teacher'));
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

        $teacher = $this->repository->find($id);

        return view('teachers.edit', compact('teacher'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  TeacherUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(TeacherUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $teacher = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Teacher updated.',
                'data'    => $teacher->toArray(),
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
                'message' => 'Teacher deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Teacher deleted.');
    }
}
