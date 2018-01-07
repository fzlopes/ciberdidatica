<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SaleCreateRequest;
use App\Http\Requests\SaleUpdateRequest;
use App\Repositories\SaleRepository;
use App\Validators\SaleValidator;


class SalesController extends Controller
{

    /**
     * @var SaleRepository
     */
    protected $repository;

    /**
     * @var SaleValidator
     */
    protected $validator;

    public function __construct(SaleRepository $repository, SaleValidator $validator)
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
        $sales = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sales,
            ]);
        }

        return view('sales.index', compact('sales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SaleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SaleCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $sale = $this->repository->create($request->all());

            $response = [
                'message' => 'Sale created.',
                'data'    => $sale->toArray(),
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
        $sale = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sale,
            ]);
        }

        return view('sales.show', compact('sale'));
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

        $sale = $this->repository->find($id);

        return view('sales.edit', compact('sale'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  SaleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(SaleUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $sale = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Sale updated.',
                'data'    => $sale->toArray(),
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
                'message' => 'Sale deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Sale deleted.');
    }
}
