<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Nht\Hocs\Entrusts\RoleRepository;
use Nht\Http\Requests\AdminPermissionFormRequest;
use Nht\Hocs\Entrusts\PermissionRepository;
use Nht\Http\Controllers\Admin\AdminController;

class PermissionController extends AdminController
{
	protected $role;
	protected $perm;

	public function __construct(RoleRepository $role, PermissionRepository $perm)
	{
        if (\Auth::user()->id != 1) {
            abort(403);
        }
		$this->role = $role;
		$this->perm = $perm;
		parent::__construct();
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        $this->setFilter($request, 'name', 'LIKE');
        $filter = $this->getFilter();
        $sorter = $this->getSorter($request);
		$permissions = $this->perm->getAll($filter, $sorter, 25);
		return view('admin/permissions/index', compact('permissions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin/permissions/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AdminPermissionFormRequest $request)
	{
		if ($perm = $this->perm->create($request->all()))
		{
            return $this->redirectOk('permission.create', trans('general.messages.create_success'));
		}
        return $this->redirectFail(trans('general.messages.create_fail'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$permission = $this->perm->getById($id);
        return view('admin/permissions/edit', compact('permission'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, AdminPermissionFormRequest $request)
	{
		if ($this->perm->update($id, $request->except('_token')))
        {
            return $this->redirectOk(['permission.edit', $id], trans('general.messages.update_success'));
        }
        return $this->redirectFail(trans('general.messages.update_fail'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ($this->perm->delete($id))
        {
            return $this->redirectOk('permission.index', trans('general.messages.delete_success'));
        }
        return $this->redirectOk('permission.index', trans('general.messages.delete_fail'));
	}
}
