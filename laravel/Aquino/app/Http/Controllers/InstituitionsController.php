<?php

namespace App\Http\Controllers;

use App\Entities\Instituition;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstituitionCreateRequest;
use App\Http\Requests\InstituitionUpdateRequest;
use App\Repositories\InstituitionRepository;
use App\Validators\InstituitionValidator;
use App\Services\InstituitionService;

/**
 * Class InstituitionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstituitionsController extends Controller
{
    /**
     * @var InstituitionRepository
     */
    protected $repository;

    /**
     * @var InstituitionService
     */
    protected $service;

    /**
     * InstituitionsController constructor.
     *
     * @param InstituitionRepository $repository
     * @param InstituitionService $service
     */
    public function __construct(InstituitionRepository $repository, InstituitionService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituition = $this->repository->all();

        return view('instituitions.index', [
            'instituitions' => $instituition,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstituitionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InstituitionCreateRequest $request)
    {
        $request        = $this->service->store($request->all());
        $instituition   = $request['success'] ? $request['data'] : null;
        
        session()->flash('sessionSuccess', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);

        return redirect()->route('instituition.index');    
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
        $instituition = $this->repository->find($id);

        return view('instituitions.show', [
            'instituition' => $instituition
        ]);
        
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
        $instituition = $this->repository->find($id);

        return view('instituitions.edit', [
            'instituition' => $instituition
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstituitionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, $id)
    {
        $request        = $this->service->update($request->all(), $id);
        $instituition   = $request['success'] ? $request['data'] : null;
        
        session()->flash('sessionSuccess', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);

        return redirect()->route('instituition.index'); 
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

        if (request()->wantsJson()) 
        {
            return response()->json([
                'message' => 'Instituition deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('instituition.index');
    }
}
