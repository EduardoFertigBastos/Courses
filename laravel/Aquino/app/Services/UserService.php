<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Exception;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use Prettus\Validator\Contracts\ValidatorInterface;

class UserService 
{
    private $repository;
    private $validator;

    // Ocorre a instanciação da classe no parametro, é a mesma coias que
    // $oRepository = new UserRepository();
    public function __construct(UserRepository $oRepository, UserValidator $oValidator)
    {
        $this->repository = $oRepository;
        $this->validator = $oValidator;
    }

    public function store($aData)
    {
        try
        {
            // Validação dos dados
            $this->validator->with($aData)->passesOrFail(ValidatorInterface::RULE_CREATE);
            
            // $aData são as informações do usuário. Passa os dados como parametro para fazer a inserção.
            $oUsuario = $this->repository->create($aData); 

            return [
                'success'   => true,
                'messages'  => 'Usuário cadastrado',
                'data'      => $oUsuario
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
            $oUsuario = $this->repository->update($aData, $id); 

            return [
                'success'   => true,
                'messages'  => 'Usuário atualizado',
                'data'      => $oUsuario
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

    public function delete($iId)
    {
        try
        {
            $oUsuario = $this->repository->destroy($iId); 

            return [
                'success'   => true,
                'messages'  => 'Usuário removido',
                'data'      => null
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