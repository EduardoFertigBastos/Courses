<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function homepage() 
    {
        $sTit = "Homepage do Sistema";
        return view('welcome', [
            'sTitle' => $sTit
        ]);
    }

    public function cadastrar()
    {
        echo 'Tela de Cadastro';
    }

    public function effectLogin()
    {
        return view('user.login');
    }
}
