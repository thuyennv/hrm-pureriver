<?php

namespace Nht\Hocs\Recesses;

interface RecessRepository
{
    public function getAll($filter, $sorter, $paginate);
    public function getById($id);
    public function create($attributes);
    public function update($id, $attributes);
    public function delete($id);
}
