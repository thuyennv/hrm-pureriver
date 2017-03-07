<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Nht\Http\Requests\AdminRoleFormRequest;
use Nht\Http\Controllers\Admin\AdminController;
use Nht\Hocs\Entrusts\RoleRepository;
use Nht\Hocs\Entrusts\PermissionRepository;


class RoleController extends AdminController
{
	 protected $role;
	 protected $perm;

	public function __construct(RoleRepository $role, PermissionRepository $perm)
	{
        $this->role = $role;
        $this->perm = $perm;
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index(Request $request)
	{
        // softer
        $sorter = $sorter = $this->getSorter($request);
        $roles = $this->role->getAll(false, $sorter, 25);
        return view('admin/roles/index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create()
	{
		$permissions = $this->perm->getAllWithSort();
		return view('admin/roles/create', compact('permissions'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @return Response
	 */
	 public function store(AdminRoleFormRequest $request)
	 {
		if ($newRole = $this->role->create($request->all()))
		{
			$perms = (array) $request->get('perms');
			$newRole->perms()->sync($perms);
            return $this->redirectOk('role.create', trans('general.messages.create_success'));
		}
        return $this->redirectFail(trans('general.messages.create_fail'));
	 }

	/**
	 * Show the form for editing the specified resource.
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        // Không view The God
        $this->isTheGod($id);

        $role = $this->role->getById($id);
		$permissions = $this->perm->getAllWithSort();
		$role_permissions = array_pluck($role->perms, 'id');
		return view('admin/roles/edit', compact('role', 'permissions', 'role_permissions'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, AdminRoleFormRequest $request)
	{
        // Không edit The God
        $this->isTheGod($id);

		if ($role = $this->role->update($id, $request->except('_token', 'perms')))
		{
    		$perms = (array) $request->get('perms');
    		$role->perms()->sync($perms);
            return $this->redirectOk(['role.edit', $id], trans('general.messages.update_success'));
		}
        return $this->redirectFail(trans('general.messages.update_fail'));
	}

	/**
	 * Remove the specified resource from storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        // Không delete The God
        $this->isTheGod($id);

		if ($this->role->delete($id))
		{
            return $this->redirectOk('role.index', trans('general.messages.delete_success'));
		}
        $this->redirectOk('role.index', trans('general.messages.delete_fail', 'error'));
	}

    /**
     * Không thao tác với role God nếu không phải là God
     * @return void|403view
     */
    private function isTheGod($id)
    {
        $id = (int) $id;
        if ($id === 1 && \Auth::user()->id !== 1) {
            abort(403);
        }
    }
}
