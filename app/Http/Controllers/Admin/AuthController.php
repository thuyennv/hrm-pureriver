<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Nht\Http\Controllers\Admin\AdminController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Nht\Hocs\Workdays\WorkdayRepository;
use Carbon\Carbon;

/**
 * Class description.
 *
 * @author	AlvinTran
 */
class AuthController extends AdminController
{
	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	protected $loginPath = '/admin/login';
	protected $redirectPath = '/admin/dashboard';
	protected $redirectAfterLogout = '/admin/login';

	/**
    * Override getLogin method in Illuminate/Auth/AuthenticatesUsers trait
    * @return View
    */
	public function getLogin()
	{
		return view('admin.login');
	}

	/**
	 * View dashboard
	 * @return View
	 */
	public function dashboard(WorkdayRepository $wd, Request $request)
	{
        $totalMenHours = 0;
        $totalWorkdays = 0;
        $start = $request->get('startdate');
        $end = $request->get('enddate');

        $data = [[
            'Time' => time(),
            'Checkin' => 0,
            'Menhours' => 0
        ]];
        $workdays = $wd->getByTimeAndId();
        $allWorkDay = $wd->getWorkdayForChart($this->auth->user()->id, $start, $end);

        foreach ($allWorkDay as $ind => $wd) {
            $data[$ind]['Time'] = strtotime($wd->mydate);
            $data[$ind]['Checkin'] = $wd->count;
            $data[$ind]['Menhours'] = $wd->menhours;
            $totalMenHours += $wd->menhours;
            $totalWorkdays += $wd->count;
        }

        $data = json_encode($data);
		return view('admin/dashboard', compact('workdays', 'data', 'totalWorkdays', 'totalMenHours'));
	}
}
