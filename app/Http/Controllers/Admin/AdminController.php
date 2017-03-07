<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard as Auth;
use Nht\Hocs\Users\UserRepository;
use Nht\Http\Controllers\Controller;
use Carbon\Carbon;

class AdminController extends Controller {

	/**
	 * Keep track logged user
	 */
	protected $auth;

    /**
     * Filter list
     * @var array
     */
    protected $filter = [];

    /**
     * Constructor
     */
	public function __construct()
	{
		$this->auth = \App::make(Auth::class);
	}

    /**
     * Sorter
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getSorter(Request $request)
    {
        $sorter = ['created_at', 'DESC'];
        $request->get('field_sort') && $request->get('type_sort')
            ? $sorter = [$request->get('field_sort'), $request->get('type_sort')]
            : false;
        return $sorter;
    }

    /**
     * Set filter
     * @param Request $request  [description]
     * @param [type]  $field    [description]
     * @param [type]  $ope      [description]
     * @param [type]  $defValue [description]
     */
    public function setFilter(Request $request, $field, $ope, $defValue = null)
    {
        if ($defValue == null) {
            $value = $request->get($field);
        } else {
            $value = $defValue;
        }

        if ($value != '' || $value != null) {
            if ($ope == 'LIKE') {
                $value = '%' . $value . '%';
            }
            $this->filter[] = [$field, $ope, $value];
        }
    }

    /**
     * Get all filter
     * @return [type] [description]
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Redirect with success
     * @param  string $route   [description]
     * @param  string $message [description]
     * @return Redirect
     */
    public function redirectOk($route, $message, $level = 'success')
    {
        if (is_array($route)) {
            list($routeName, $routeParam) = $route;
            return redirect()->route($routeName, $routeParam)->with('success', $message);
        }
        return redirect()->route($route)->with($level, $message);
    }

    /**
     * Redirect with fail
     * @param  string $message
     * @return Redirect
     */
    public function redirectFail($message)
    {
        return redirect()->back()->withInputs()->with('error', $message);
    }

    /**
     * Redirect back
     * @param  string $message
     * @return Redirect
     */
    public function redirectBack($message)
    {
        return redirect()->back()->with('warning', $message);
    }
}
