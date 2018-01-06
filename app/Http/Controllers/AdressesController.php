<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AdressCreateRequest;
use App\Http\Requests\AdressUpdateRequest;
use App\Repositories\AdressRepository;
use App\Validators\AdressValidator;


class AdressesController extends Controller
{

    /**
     * @var AdressRepository
     */
    protected $repository;

    /**
     * @var AdressValidator
     */
    protected $validator;

    public function __construct(AdressRepository $repository, AdressValidator $validator)
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
        $adresses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $adresses,
            ]);
        }

        return view('adresses.index', compact('adresses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdressCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdressCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $adress = $this->repository->create($request->all());

            $response = [
                'message' => 'Adress created.',
                'data'    => $adress->toArray(),
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
        $adress = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $adress,
            ]);
        }

        return view('adresses.show', compact('adress'));
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

        $adress = $this->repository->find($id);

        return view('adresses.edit', compact('adress'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  AdressUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(AdressUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $adress = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Adress updated.',
                'data'    => $adress->toArray(),
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
                'message' => 'Adress deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Adress deleted.');
    }
}
