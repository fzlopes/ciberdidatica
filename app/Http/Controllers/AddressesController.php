<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AddressCreateRequest;
use App\Http\Requests\AddressUpdateRequest;
use App\Repositories\AddressRepository;
use App\Validators\AddressValidator;


class AddressesController extends Controller
{

    /**
     * @var AddressRepository
     */
    protected $repository;

    /**
     * @var AddressValidator
     */
    protected $validator;

    public function __construct(AddressRepository $repository, AddressValidator $validator)
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
        $addresses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $addresses,
            ]);
        }

        return view('addresses.index', compact('addresses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AddressCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddressCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $address = $this->repository->create($request->all());

            $response = [
                'message' => 'Address created.',
                'data'    => $address->toArray(),
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
        $address = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $address,
            ]);
        }

        return view('addresses.show', compact('address'));
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

        $address = $this->repository->find($id);

        return view('addresses.edit', compact('address'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  AddressUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(AddressUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $address = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Address updated.',
                'data'    => $address->toArray(),
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
                'message' => 'Address deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Address deleted.');
    }
}
