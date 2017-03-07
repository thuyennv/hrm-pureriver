<?php

namespace Nht\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckPermission
{
    protected $auth;
    /**
     * Creates a new instance of the middleware.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions)
    {
        if ($this->userHasAccessTo($request, $permissions))
        {
            view()->share('currentUser', $request->user());
            return $next($request);
        }
        return abort(403);
    }

    /**
     * Validate access controls
     * @param  Request $request
     * @param  string $permissions
     * @return bool
     */
    public function userHasAccessTo($request, $permissions)
    {
        if ($this->auth->guest()) {
            return false;
        }

        if ($request->user()->hasRole('superadmin')) {
            return true;
        }

        $permissions = $this->getAllPermissions($request, $permissions);
        if (count($permissions) > 1) {
            $permissions = array_flip($permissions);
            unset($permissions['admin']);
            $permissions = array_flip($permissions);
        }

        return $request->user()->can($permissions);
    }

    /**
     * Get all permissions
     * @param  Request $request
     * @param  string $permissions
     * @return array
     */
    public function getAllPermissions($request, $permissions)
    {
        $action = $request->route()->getAction();
        $actPermissions = isset($action['permissions']) ? $action['permissions'] : null;

        if ($permissions == '' || $actPermissions === '') {
            throw new \Exception("Permissions trên routes không thể bỏ trống.");
        }

        // Extract permissions
        if ($actPermissions) {
            $permissions = $permissions . '|' . $actPermissions;
        }
        return explode('|', $permissions);
    }
}
