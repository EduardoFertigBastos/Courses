<?php

namespace App\Services;

use App\Repositories\InstituitionRepository;
use App\Validators\InstituitionValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Exception;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use Prettus\Validator\Contracts\ValidatorInterface;

class InstituitionService 
{
    private $repository;
    private $validator;

    // Ocorre a instanciação da classe no parametro, é a mesma coias que
    // $oRepository = new UserRepository();
    public function __construct(InstituitionRepository $oRepository,InstituitionValidator $oValidator)
    {
        $this->repository = $oRepository;
        $this->validator = $oValidator;
    }

    public function store($aData) 
    {
        try
        {
            $this->validator->with($aData)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $oInstituition = $this->repository->create($aData);
            return [
                'success'   => true,
                'messages'  => 'Instituição cadastrado',
                'data'      => $oInstituition,
            ];
        }
        catch (Exception $erro)
        {
            return [
                'success'   => false,
                'messages'  => 'Erro de Execução: ' . $erro->getMessage(),
            ];
        }
    }

    public function update($aData, $id)
    {
        try
        {
            $this->validator->with($aData)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $oInstituition = $this->repository->update($aData, $id);
            
            return [
                'success'   => true,
                'messages'  => 'Instituição cadastrado',
                'data'      => $oInstituition,
            ];
        }
        catch (Exception $erro)
        {
            return [
                'success'   => false,
                'messages'  => 'Erro de Execução: ' . $erro->getMessage(),
            ];
        }

    }
}