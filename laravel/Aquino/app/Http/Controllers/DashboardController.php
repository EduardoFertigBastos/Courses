<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index() 
    {
        return view('user.dashboard');
    }
    
    public function auth(Request $oRequest) 
    {
        $aData = [
            'email' => $oRequest->get('username'),
            'password' => $oRequest->get('password')
        ]; 

        try
        {
            //Senha criptografada
            if (env('PASSWORD_HASH'))
            {
                Auth::attempt($aData, true);
            }
            else // Senha não criptografada  
            {
                // Verifica se o e-mail existe
                $oUser = $this->repository->findWhere(['email' => $oRequest->get('username')])->first();

                if (!$oUser) 
                {
                    throw new Exception("E-mail inválido, meu camarada");
                }

                //Verifica se a senha é correta
                if ($oUser->password != $oRequest->get('password'))
                {
                    throw new Exception("Senha inválida");
                }

                Auth::login($oUser);                
            }

            return redirect()->route('user.dashboard');
        }
        catch (Exception $oErro)
        {
            return $oErro->getMessage() . ' ' . $oErro->getLine();
        }
        

        //Var_dump and die
        dd($oRequest->all());
    }
}
