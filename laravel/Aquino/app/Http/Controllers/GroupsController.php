<?php

namespace App\Http\Controllers;

use App\Entities\Instituition;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;
use App\Repositories\InstituitionRepository;
use App\Repositories\UserRepository;
use App\Validators\GroupValidator;
use App\Services\GroupService;

/**
 * Class GroupsController.
 *
 * @package namespace App\Http\Controllers;
 */
class GroupsController extends Controller
{
    /**
     * @var InstituitionRepository
     */
    protected $instituitionrepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var GroupRepository
     */
    protected $repository;

    /**
     * @var GroupService
     */
    protected $service;

    /**
     * GroupsController constructor.
     *
     * @param GroupRepository $repository
     * @param GroupService $service
     */
    public function __construct(GroupRepository $repository, UserRepository $userRepository,
                                InstituitionRepository $instituitionRepository, GroupService $service)
    {
        $this->repository               = $repository;
        $this->userRepository           = $userRepository;
        $this->instituitionRepository   = $instituitionRepository;
        $this->service                  = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups         = $this->repository->all();

        //$user = \App\Entities\User::pluck('name', 'id')->all();
        $users          = $this->userRepository->selectBoxList();
        $instituitions  = $this->instituitionRepository->selectBoxList();
        


        return view('groups.index', [
            'groups'            => $groups,
            'aUserList'         => $users,
            'aInstituitionList' => $instituitions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(GroupCreateRequest $request)
    {        
        $request        = $this->service->store($request->all());
        $group   = $request['success'] ? $request['data'] : null;
        
        session()->flash('sessionSuccess', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);

        return redirect()->route('group.index');
    }

    public function userStore(Request $request, $group_id)
    {
        $request  = $this->service->userStore($group_id, $request->all());
        
        session()->flash('sessionSuccess', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);

        return redirect()->route('group.show', [$group_id]);
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
        $group      = $this->repository->find($id);
        $user_list  = $this->userRepository->selectBoxList();

        return view('groups.show', [
            'group'     => $group,
            'user_list' => $user_list
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
        $group = $this->repository->find($id);        
        $users          = $this->userRepository->selectBoxList();
        $instituitions  = $this->instituitionRepository->selectBoxList();

        return view('groups.edit', [
            'group' => $group,
            'aUserList' => $users,
            'aInstituitionList' => $instituitions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GroupUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, $id)
    {
        $request        = $this->service->update($request->all(), $id);
        $group   = $request['success'] ? $request['data'] : null;
        
        session()->flash('sessionSuccess', [
            'success'   => $request['success'],
            'messages'  => $request['messages'],
        ]);

        return redirect()->route('group.index');
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

        return redirect()->route('group.index');
    }
}
