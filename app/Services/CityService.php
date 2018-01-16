<?php

namespace App\Services;

use Prettus\Validator\Contracts\ValidatorInterface;
use App\Repositories\CityRepository;
use App\Validators\CityValidator;
use Exception;

class CityService
{
    private $repository;
    private $validator;

    public function __construct(CityRepository $repository, CityValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


    public function store($data)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $city = $this->repository->create($data);

            return [
                'success' => true,
                'messages' => "Cidade cadastrada.",
                'data' => $city,

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
            $city = $this->repository->update($data, $id);

            return [
                'success' => true,
                'messages' => "Cidade alterada.",
                'data' => $city,

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
                'messages' => "Cidade removida.",
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