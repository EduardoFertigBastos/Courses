<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MovementCreateRequest;
use App\Http\Requests\MovementUpdateRequest;
use App\Repositories\MovementRepository;
use App\Validators\MovementValidator;
use App\Entities\Group;
use App\Entities\Products;
use App\Entities\Movement;
use Auth;

/**
 * Class MovementsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MovementsController extends Controller
{
    /**
     * @var MovementRepository
     */
    protected $repository;

    /**
     * @var MovementValidator
     */
    protected $validator;

    /**
     * MovementsController constructor.
     *
     * @param MovementRepository $repository
     * @param MovementValidator $validator
     */
    public function __construct(MovementRepository $repository, MovementValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index()
    {
        return view('movement.index', [
            'product_list' => Products::all(),
        ]);
    }

    public function application()
    {
        $user = Auth::user();
        $groupList      = Auth::user()->groups->pluck('name', 'id');
        $productList    = Products::all()->pluck('name', 'id');

        return view('movement.application', [
            'groupList' => $groupList,
            'productList' => $productList,
        ]);
    }

    public function storeApplication(Request $request) 
    {
        
        $movement = Movement::create([
            'user_id'       => Auth::user()->id,
            'group_id'      => $request->get('group_id'),
            'products_id'    => $request->get('products_id'),
            'value'         => $request->get('value'),
            'type'         => 1,
        ]);

        session()->flash('success', [
            'success'   => true,
            'messages'  => "Aplicação de R$" . $movement->value . "no 
                            produto realizada com sucesso!",
        ]);

        return redirect()->route('movement.application');
    }

    public function all()
    {
        $movement_list = Auth::user()->movements;

        return view('movement.all', [
            'movement_list' => $movement_list
        ]);
    }

    public function getBack()
    {
        $user = Auth::user();
        $groupList      = Auth::user()->groups->pluck('name', 'id');
        $productList    = Products::all()->pluck('name', 'id');

        return view('movement.getBack', [
            'groupList' => $groupList,
            'productList' => $productList,
        ]);
    }

    public function storeGetBack(Request $request) 
    {
        
        $movement = Movement::create([
            'user_id'       => Auth::user()->id,
            'group_id'      => $request->get('group_id'),
            'products_id'    => $request->get('products_id'),
            'value'         => $request->get('value'),
            'type'         => 2,
        ]);

        session()->flash('success', [
            'success'   => true,
            'messages'  => "Resgate de R$" . $movement->value . "no 
                            produto realizada com sucesso!",
        ]);

        return redirect()->route('movement.getBack');
    }
}