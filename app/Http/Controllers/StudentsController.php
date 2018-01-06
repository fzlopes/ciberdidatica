<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Repositories\StudentRepository;
use App\Validators\StudentValidator;


class StudentsController extends Controller
{

    /**
     * @var StudentRepository
     */
    protected $repository;

    /**
     * @var StudentValidator
     */
    protected $validator;

    public function __construct(StudentRepository $repository, StudentValidator $validator)
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
        $students = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $students,
            ]);
        }

        return view('students.index', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StudentCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $student = $this->repository->create($request->all());

            $response = [
                'message' => 'Student created.',
                'data'    => $student->toArray(),
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
        $student = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $student,
            ]);
        }

        return view('students.show', compact('student'));
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

        $student = $this->repository->find($id);

        return view('students.edit', compact('student'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  StudentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(StudentUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $student = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Student updated.',
                'data'    => $student->toArray(),
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
                'message' => 'Student deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Student deleted.');
    }
}
