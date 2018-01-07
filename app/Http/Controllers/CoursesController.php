<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CourseCreateRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Repositories\CourseRepository;
use App\Validators\CourseValidator;


class CoursesController extends Controller
{

    /**
     * @var CourseRepository
     */
    protected $repository;

    /**
     * @var CourseValidator
     */
    protected $validator;

    public function __construct(CourseRepository $repository, CourseValidator $validator)
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
        $courses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $courses,
            ]);
        }

        return view('courses.index', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CourseCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CourseCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $course = $this->repository->create($request->all());

            $response = [
                'message' => 'Course created.',
                'data'    => $course->toArray(),
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
        $course = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $course,
            ]);
        }

        return view('courses.show', compact('course'));
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

        $course = $this->repository->find($id);

        return view('courses.edit', compact('course'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CourseUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CourseUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $course = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Course updated.',
                'data'    => $course->toArray(),
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
                'message' => 'Course deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Course deleted.');
    }
}
