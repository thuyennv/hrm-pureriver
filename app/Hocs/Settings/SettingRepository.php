<?php

namespace Nht\Hocs\Settings;

interface SettingRepository
{
    public function getAll($filter, $sorter, $paginate);
    public function getById($id);
    public function create($attributes);
    public function update($id, $attributes);
    public function delete($id);
}
