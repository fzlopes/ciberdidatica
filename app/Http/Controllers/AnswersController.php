<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AnswerCreateRequest;
use App\Http\Requests\AnswerUpdateRequest;
use App\Repositories\AnswerRepository;
use App\Validators\AnswerValidator;


class AnswersController extends Controller
{

    /**
     * @var AnswerRepository
     */
    protected $repository;

    /**
     * @var AnswerValidator
     */
    protected $validator;

    public function __construct(AnswerRepository $repository, AnswerValidator $validator)
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
        $answers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $answers,
            ]);
        }

        return view('answers.index', compact('answers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AnswerCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $answer = $this->repository->create($request->all());

            $response = [
                'message' => 'Answer created.',
                'data'    => $answer->toArray(),
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
        $answer = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $answer,
            ]);
        }

        return view('answers.show', compact('answer'));
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

        $answer = $this->repository->find($id);

        return view('answers.edit', compact('answer'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  AnswerUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(AnswerUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $answer = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Answer updated.',
                'data'    => $answer->toArray(),
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
                'message' => 'Answer deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Answer deleted.');
    }
}
