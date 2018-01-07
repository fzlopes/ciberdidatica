<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ModuleCreateRequest;
use App\Http\Requests\ModuleUpdateRequest;
use App\Repositories\ModuleRepository;
use App\Validators\ModuleValidator;


class ModulesController extends Controller
{

    /**
     * @var ModuleRepository
     */
    protected $repository;

    /**
     * @var ModuleValidator
     */
    protected $validator;

    public function __construct(ModuleRepository $repository, ModuleValidator $validator)
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
        $modules = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $modules,
            ]);
        }

        return view('modules.index', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ModuleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $module = $this->repository->create($request->all());

            $response = [
                'message' => 'Module created.',
                'data'    => $module->toArray(),
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
        $module = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $module,
            ]);
        }

        return view('modules.show', compact('module'));
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

        $module = $this->repository->find($id);

        return view('modules.edit', compact('module'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ModuleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ModuleUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $module = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Module updated.',
                'data'    => $module->toArray(),
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
                'message' => 'Module deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Module deleted.');
    }
}
