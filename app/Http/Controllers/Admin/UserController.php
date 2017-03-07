<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Nht\Http\Controllers\Admin\AdminController;
use Nht\Hocs\Entrusts\RoleRepository;
use Nht\Http\Requests\AdminUserFormRequest;
use Nht\Http\Requests\AdminPasswordFormRequest;
use Nht\Hocs\Users\UserRepository;
use Hash, Xss, Auth;


/**
 * Class description.
 *
 * @author  AlvinTran
 */
class UserController extends AdminController
{
	protected $user;
	protected $role;

	public function __construct(UserRepository $user, RoleRepository $role)
	{
		$this->user    = $user;
		$this->role    = $role;
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
        $this->setFilter($request, 'email', '=');
        $this->setFilter($request, 'phone', 'LIKE');
        $filter = $this->getFilter();

		// softer
		$sorter = $this->getSorter($request);

      	$users = $this->user->getAll($filter, $sorter, 25);
		return view('admin/users/index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = $this->role->getAll();
        $types = $this->user->getTypes();
		return view('admin/users/create', compact('roles', 'types'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AdminUserFormRequest $request)
	{
		if ($this->user->create($request->all())) {
            return $this->redirectOk('user.create', trans('general.messages.create_success'));
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
		// Không cho edit tài khoản superadmin
		if ($id == 1 && \Auth::user()->id != 1)
		{
			abort(403);
		}

		$user = $this->user->getById($id);
		$roles = $this->role->getAll();
        $types = $this->user->getTypes();
		$user_roles = array_pluck($user->roles, 'id');
		return view('admin/users/edit', compact('user', 'roles', 'user_roles', 'types'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, AdminUserFormRequest $request)
	{
		// Không cho edit tài khoản superadmin
		if ($id == 1 && \Auth::user()->id != 1)
		{
			abort(403);
		}

		if ($this->user->update($id, $request->all()))
		{
            return $this->redirectOk(['user.edit', $id], trans('general.messages.create_success'));
		}
        return $this->redirectFail(trans('general.messages.update_fail'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function profile()
	{
		$user = $this->auth->user();
		return view('admin/users/profile', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function updateProfile(AdminUserFormRequest $request)
	{
		$user = $this->auth->user();
		if ($this->user->update($user->id, $request->except('email', 'password', 'role[]')))
		{
            return $this->redirectOk('user.profile', trans('general.messages.update_success'));
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
        if ($id == 1 && \Auth::user()->id != 1)
        {
            abort(403);
        }
        $this->user->delete($id);
        return $this->redirectOk('user.index', trans('general.messages.delete_success'));
	}

	public function active($id) {
		// Không cho edit tài khoản superadmin trừ chính superadmin
		if ($id == 1 && \Auth::user()->id != 1)
		{
			abort(403);
		}

		$user = $this->user->getById($id);
        $obsolete = $user->active;
		$user->fill(['active' => !$user->active])->save();
		if($user->active != $obsolete) {
		   return [
		       'code' => 1,
		       'messages' => 'Cập nhật thành công',
		       'status' => $user->active
		   ];
		}
		return ['code' => 0, 'messages' => 'Cập nhật thất bại'];
	}

	/**
	 * Đổi mật khẩu
	 * @return View
	 */
	public function password() {
		return view('admin/users/password');
	}

	/**
	 * Đổi mật khẩu
	 * @param  AdminPasswordFormRequest $request
	 * @return redirect
	 */
	public function changePassword(AdminPasswordFormRequest $request) {
		if (Hash::check($request->get('old_password'), $this->auth->user()->password)) {
			$this->auth->user()->fill([
				'password' => bcrypt($request->get('password'))
			])->save();
			Auth::logout();
			return redirect()->to('/admin/login')->with('message', 'Đổi mật khẩu thành công, đăng nhập lại để tiếp tục');
		}
		return redirect()->back()->with('error', 'Mật khẩu không đúng');
	}
}
