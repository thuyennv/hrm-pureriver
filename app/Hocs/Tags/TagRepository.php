<?php

namespace Nht\Hocs\Tags;

/**
 * Interface description.
 *
 * @author	lcn
 */
interface TagRepository
{
    public function getAll($filter, $sorter, $paginate);
    public function getById($id);
    public function create($attributes);
    public function update($id, $attributes);
    public function delete($id);
	public function getTagByName($tagName);
	public function getTagBySlug($slug);
	public function searchTag($tag);
	public function getTopTagByRelaysionship($num = 10, $pagiSize = 100);
}
