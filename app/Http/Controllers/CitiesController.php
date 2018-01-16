<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CityCreateRequest;
use App\Http\Requests\CityUpdateRequest;
use App\Repositories\CityRepository;
use App\Services\CityService;
use App\Repositories\StateRepository;


class CitiesController extends Controller
{

    /**
     * @var CityRepository
     */
    protected $repository;

    /**
     * @var CityService
     */
    protected $service;

    /**
     * @var StateRepository
     */
    protected $staterRepository;

    public function __construct(CityRepository $repository, CityService $service, StateRepository $stateRepository)
    {
        $this->repository      = $repository;
        $this->validator       = $validator;
        $this->stateRepository = $stateRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = $this->repository->all();
        $states = $this->stateRepository->selectBoxList();
       
        return view('cities.index', compact('cities', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CityCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CityCreateRequest $request)
    {

        $request = $this->service->store($request->all());
        $group = $request['success'] ? $request['data'] : null;

        session()->flash('success', [
            'success' => $request['success'],
            'messages' => $request['messages'],
        ]);


        return redirect()->route('city.index');
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
        $city = $this->repository->find($id);
        $states = $this->staterRepository->selectBoxList();

        return view('cities.show', compact('city', 'states'));
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

        $city = $this->repository->find($id);
        $states = $this->stateRepository->selectBoxList();
                
        return view('cities.edit', compact('city', 'users'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CityUpdateRequest $request, $id)
    {

        $request = $this->service->update($request->all(), $id);
        $city = $request['success'] ? $request['data'] : null;

        session()->flash('success', [
            'success' => $request['success'],
            'messages' => $request['messages'],
        ]);


        return redirect()->route('cities.index');
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
            'success'  => $request['success'],
            'messages' => $request['messages'], 
        ]);


        return redirect()->route('cities.index');
    }
}
