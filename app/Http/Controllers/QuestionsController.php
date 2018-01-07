<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Repositories\QuestionRepository;
use App\Validators\QuestionValidator;


class QuestionsController extends Controller
{

    /**
     * @var QuestionRepository
     */
    protected $repository;

    /**
     * @var QuestionValidator
     */
    protected $validator;

    public function __construct(QuestionRepository $repository, QuestionValidator $validator)
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
        $questions = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $questions,
            ]);
        }

        return view('questions.index', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  QuestionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $question = $this->repository->create($request->all());

            $response = [
                'message' => 'Question created.',
                'data'    => $question->toArray(),
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
        $question = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $question,
            ]);
        }

        return view('questions.show', compact('question'));
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

        $question = $this->repository->find($id);

        return view('questions.edit', compact('question'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  QuestionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(QuestionUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $question = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Question updated.',
                'data'    => $question->toArray(),
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
                'message' => 'Question deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Question deleted.');
    }
}
