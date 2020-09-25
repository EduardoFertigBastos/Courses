<?php

namespace App\Services;

use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Exception;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use Prettus\Validator\Contracts\ValidatorInterface;

class GroupService 
{
    private $repository;
    private $validator;

    // Ocorre a instanciação da classe no parametro, é a mesma coias que
    // $oRepository = new UserRepository();
    public function __construct(GroupRepository $oRepository,GroupValidator $oValidator)
    {
        $this->repository = $oRepository;
        $this->validator = $oValidator;
    }

    public function store($aData) 
    {
        try
        {
            $this->validator->with($aData)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $oGroup = $this->repository->create($aData);
            return [
                'success'   => true,
                'messages'  => 'Grupo cadastrado',
                'data'      => $oGroup,
            ];
        }
        catch (Exception $erro)
        {
            return [
                'success'   => false,
                'messages'  => 'Erro de Execução: ' . $erro->getMessage()
            ];
        }
    }

    public function userStore($group_id, $data)
    {
        try
        {
            $group      = $this->repository->find($group_id);
            $user_id    = $data['user_id']; 

            $group->users()->attach($user_id);
            
            return [
                'success'   => true,
                'messages'  => 'Usuário relacionado com sucesso',
                'data'      => $group
            ];
        }
        catch (Exception $erro)
        {
            return [
                'success'   => false,
                'messages'  => 'Erro de Execução: ' . dd($erro)
            ];
        }
    }

    public function update($aData, $id)
    {
        try
        {
            $this->validator->with($aData)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $oGroup = $this->repository->update($aData, $id);
            return [
                'success'   => true,
                'messages'  => 'Grupo cadastrado',
                'data'      => $oGroup,
            ];
        }
        catch (Exception $erro)
        {
            return [
                'success'   => false,
                'messages'  => 'Erro de Execução: ' . $erro->getMessage()
            ];
        }
    }
}