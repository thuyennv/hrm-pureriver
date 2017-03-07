<?php

namespace Nht\Hocs\Blogs;

/**
 * Interface description.
 *
 * @author	lcn
 */
interface BlogRepository
{
    public function getAll($filter, $sorter, $paginate);
    public function getById($id);
    public function create($attributes);
    public function update($id, $attributes);
    public function delete($id);
	public function getRandomName($filename);
	public function saveTag(Blog $blog, $arrTags);
	public function getFeatureBlogs($count = 5);
	public function getAllByTagWithPaginate($tagId, $pageSize = 20);
	public function getLQ($category_id);
}
