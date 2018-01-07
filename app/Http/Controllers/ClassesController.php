<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ClassCreateRequest;
use App\Http\Requests\ClassUpdateRequest;
use App\Repositories\ClassRepository;
use App\Validators\ClassValidator;


class ClassesController extends Controller
{

    /**
     * @var ClassRepository
     */
    protected $repository;

    /**
     * @var ClassValidator
     */
    protected $validator;

    public function __construct(ClassRepository $repository, ClassValidator $validator)
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
        $classes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $classes,
            ]);
        }

        return view('classes.index', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClassCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ClassCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $class = $this->repository->create($request->all());

            $response = [
                'message' => 'Class created.',
                'data'    => $class->toArray(),
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
        $class = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $class,
            ]);
        }

        return view('classes.show', compact('class'));
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

        $class = $this->repository->find($id);

        return view('classes.edit', compact('class'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ClassUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ClassUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $class = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Class updated.',
                'data'    => $class->toArray(),
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
                'message' => 'Class deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Class deleted.');
    }
}
