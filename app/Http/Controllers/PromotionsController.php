<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PromotionCreateRequest;
use App\Http\Requests\PromotionUpdateRequest;
use App\Repositories\PromotionRepository;
use App\Validators\PromotionValidator;


class PromotionsController extends Controller
{

    /**
     * @var PromotionRepository
     */
    protected $repository;

    /**
     * @var PromotionValidator
     */
    protected $validator;

    public function __construct(PromotionRepository $repository, PromotionValidator $validator)
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
        $promotions = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $promotions,
            ]);
        }

        return view('promotions.index', compact('promotions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PromotionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $promotion = $this->repository->create($request->all());

            $response = [
                'message' => 'Promotion created.',
                'data'    => $promotion->toArray(),
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
        $promotion = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $promotion,
            ]);
        }

        return view('promotions.show', compact('promotion'));
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

        $promotion = $this->repository->find($id);

        return view('promotions.edit', compact('promotion'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PromotionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PromotionUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $promotion = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Promotion updated.',
                'data'    => $promotion->toArray(),
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
                'message' => 'Promotion deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Promotion deleted.');
    }
}
