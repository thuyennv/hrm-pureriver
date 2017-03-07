<?php

use Illuminate\Database\Seeder;
use Nht\Hocs\Entrusts\RoleRepository;
use Nht\Hocs\Entrusts\PermissionRepository;

class PermissionRoleSeeder extends Seeder
{
    protected $permission;
    protected $role;

    public function __construct(RoleRepository $roleModel, PermissionRepository $permissionModel)
    {
        $this->role       = $roleModel;
        $this->permission = $permissionModel;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role       = $this->role->getByName('superadmin');
        $permission = $this->permission->getAll();
        $role->perms()->sync($permission);
    }
}