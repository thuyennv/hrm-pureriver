<?php

namespace Nht\Hocs\Entrusts;

use Nht\Hocs\Core\BaseRepository;
use Nht\Hocs\Entrusts\Permission;

/**
 * Class description.
 *
 * @author	AlvinTran
 */
class DbPermissionRepository extends BaseRepository implements PermissionRepository
{
    /**
     * Model
     * @var Eloquent
     */
	protected $model;

    /**
     * Constructor
     * @param Permission $model
     */
	public function __construct(Permission $model)
	{
		$this->model = $model;
	}

    /**
     * Get all permission with sorting before
     * @return Collection
     */
    public function getAllWithSort()
    {
        $permissions = $this->getAll();
        $sortedPermission = [];
        foreach ($permissions as $perm) {
            $parts = explode('.', $perm->name);
            $mst = $parts[0];
            $sub = isset($pars[1]) ? $pars[1] : '';
            $perm->sub = $sub;
            $sortedPermission[$mst][] = $perm;
        }
        return $sortedPermission;
    }
}
