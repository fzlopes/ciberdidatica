<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StateCreateRequest;
use App\Http\Requests\StateUpdateRequest;
use App\Repositories\StateRepository;
use App\Services\StateService;

class StatesController extends Controller
{

    /**
     * @var StateRepository
     */
    protected $repository;

    /**
     * @var StateService
     */
    protected $service;

    public function __construct(StateRepository $repository, StateService $service)
    {
        $this->repository = $repository;
        $this->service    = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = $this->repository->all();

        return view('states.index', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StateCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StateCreateRequest $request)
    {

        $request = $this->service->store($request->all());
        $state = $request['success'] ? $request['data'] : null;

        session()->flash('success', [
            'success' => $request['success'],
            'messages' => $request['messages'],
        ]);


        return redirect()->route('state.index');
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
        $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $state,
            ]);
        }

        return view('states.show', compact('state'));
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

        $state = $this->repository->find($id);

        return view('states.edit', compact('state'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  StateUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(StateUpdateRequest $request, $id)
    {

        $request = $this->service->update($request->all(), $id);
        $state = $request['success'] ? $request['data'] : null;

        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages'],
        ]);


        return redirect()->route('state.index');
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
        $request = $this->service->destroy($id);

        session()->flash('success', [
            'success' => $request['success'],
            'messages' => $request['messages'],
        ]);


        return redirect()->route('state.index');
    }
    }
}
