<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PeopleCreateRequest;
use App\Http\Requests\PeopleUpdateRequest;
use App\Repositories\PeopleRepository;
use App\Validators\PeopleValidator;


class PeopleController extends Controller
{

    /**
     * @var PeopleRepository
     */
    protected $repository;

    /**
     * @var PeopleValidator
     */
    protected $validator;

    public function __construct(PeopleRepository $repository, PeopleValidator $validator)
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
        $people = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $people,
            ]);
        }

        return view('people.index', compact('people'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PeopleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PeopleCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $person = $this->repository->create($request->all());

            $response = [
                'message' => 'People created.',
                'data'    => $person->toArray(),
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
        $person = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $person,
            ]);
        }

        return view('people.show', compact('person'));
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

        $person = $this->repository->find($id);

        return view('people.edit', compact('person'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PeopleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PeopleUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $person = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'People updated.',
                'data'    => $person->toArray(),
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
                'message' => 'People deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'People deleted.');
    }
}
