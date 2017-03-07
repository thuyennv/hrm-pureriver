<?php

namespace Nht\Hocs\Categories;

interface CategoryRepository
{
    public function getAll($filter, $sorter, $paginate);
    public function getById($id);
    public function create($attributes);
    public function update($id, $attributes);
    public function delete($id);
	public function getListCategories($list = true, array $params = array());
	public function getCategoryBySlug($slug);
}
