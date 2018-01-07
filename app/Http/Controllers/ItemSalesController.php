<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ItemSaleCreateRequest;
use App\Http\Requests\ItemSaleUpdateRequest;
use App\Repositories\ItemSaleRepository;
use App\Validators\ItemSaleValidator;


class ItemSalesController extends Controller
{

    /**
     * @var ItemSaleRepository
     */
    protected $repository;

    /**
     * @var ItemSaleValidator
     */
    protected $validator;

    public function __construct(ItemSaleRepository $repository, ItemSaleValidator $validator)
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
        $itemSales = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $itemSales,
            ]);
        }

        return view('itemSales.index', compact('itemSales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ItemSaleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ItemSaleCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $itemSale = $this->repository->create($request->all());

            $response = [
                'message' => 'ItemSale created.',
                'data'    => $itemSale->toArray(),
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
        $itemSale = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $itemSale,
            ]);
        }

        return view('itemSales.show', compact('itemSale'));
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

        $itemSale = $this->repository->find($id);

        return view('itemSales.edit', compact('itemSale'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ItemSaleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ItemSaleUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $itemSale = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ItemSale updated.',
                'data'    => $itemSale->toArray(),
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
                'message' => 'ItemSale deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ItemSale deleted.');
    }
}
