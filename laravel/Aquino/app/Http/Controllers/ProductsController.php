<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProductsCreateRequest;
use App\Http\Requests\ProductsUpdateRequest;
use App\Repositories\ProductsRepository;
use App\Validators\ProductsValidator;
use App\Entities\Instituition;

/**
 * Class ProductsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProductsController extends Controller
{
    /**
     * @var ProductsRepository
     */
    protected $repository;

    /**
     * @var ProductsValidator
     */
    protected $validator;

    /**
     * ProductsController constructor.
     *
     * @param ProductsRepository $repository
     * @param ProductsValidator $validator
     */
    public function __construct(ProductsRepository $repository, ProductsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($instituition_id)
    {
        
        $instituition   = Instituition::find($instituition_id);

        return view('instituitions.products.index', [
            'instituition' => $instituition
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request, $instituition_id)
    {
        try {

            $data = $request->all();
            $data['instituition_id'] = $instituition_id;

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $product = $this->repository->create($data);

            $response = [
                'success'   => true,
                'messages'  => 'Produtos cadastrados.',
                'data'      => $product,
            ];

            session()->flash('sessionSuccess', [
                'success'   => $request['success'],
                'messages'  => $request['messages'],
            ]);
    
            return redirect()->route('instituition.products.index', $instituition_id);  
        } catch (ValidatorException $e) {
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
        $product = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $product,
            ]);
        }

        return view('products.show', compact('product'));
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
        $product = $this->repository->find($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ProductsUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $product = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Products updated.',
                'data'    => $product->toArray(),
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
    public function destroy($instituition_id, $product_id)
    {
        $deleted = $this->repository->delete($product_id);

        session()->flash('sessionSuccess', [
            'success'   => true,
            'messages'  => 'Produto Removido'
        ]);

        return redirect()->back();
    }
}
