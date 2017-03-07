<?php

namespace Nht\Hocs\Users;

/**
 * Interface description.
 *
 * @author	AlvinTran
 */
interface UserRepository
{
    public function getAll($filter, $sorter, $paginate);
    public function getById($id);
    public function create($attributes);
    public function update($id, $attributes);
    public function delete($id);
	public function getByEmail($email);
	public function getActivedUser($paginate);
}
