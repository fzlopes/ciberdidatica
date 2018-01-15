<?php

namespace App\Services;

use Prettus\Validator\Contracts\ValidatorInterface;
use App\Repositories\StateRepository;
use App\Validators\StateValidator;
use Exception;

class StateService
{
    private $repository;
    private $validator;

    public function __construct(StateRepository $repository, StateValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


    public function store($data)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $user = $this->repository->create($data);

            return [
                'success' => true,
                'messages' => "Estado cadastrado.",
                'data' => $state,

            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'messages' => $e->getMessage(),
            ];
        }
    }

    public function update($data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $user = $this->repository->update($data, $id);

            return [
                'success' => true,
                'messages' => "Estado alterado.",
                'data' => $state,

            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'messages' => $e->getMessage(),
            ];
        }
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return [
                'success' => true,
                'messages' => "Estado removido.",
                'data' => null,

            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'messages' => $e->getMessage(),
            ];
        }
    }
}