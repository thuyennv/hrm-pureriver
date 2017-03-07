<?php

namespace Nht\Hocs\Categories;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table   = 'categories';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'slug', 'type', 'parent_id', 'icon', 'background', 'description', 'level', 'active'
    ];

	/**
	* Định nghĩa constant
	* Trạng thái:	1: ACTIVE - 2: DEACTIVE - 3: DELETE
	*/
	const ACTIVE   = 1;
	const DEACTIVE = 2;
	const DELETE   = 3;

    /**
     * Blogs
     */
    public function blogs()
    {
        return $this->hasMany(\Nht\Hocs\Blogs\Blog::class);
    }

    /**
     * [getStatus description]
     * @return [type] [description]
     */
	public function getStatus() {
		return !!$this->active;
	}

    /**
     * [getUrlCat description]
     * @return [type] [description]
     */
	public function getUrlCat() {
		return route('frontend.blogByCategory', [ $this->id, $this->slug]);
	}

    /**
     * [getCountByParent description]
     * @return [type] [description]
     */
	public function getCountByParent() {
		return $this->where('parent_id', $this->id)->where('active', $this::ACTIVE)->count();
	}

    /**
     * [checkUrl description]
     * @param  [type] $idUrl [description]
     * @param  [type] $id    [description]
     * @return [type]        [description]
     */
	public function checkUrl($idUrl, $id) {
		if($a = $this->where('id', $idUrl)->where('path', 'LIKE' , '%-'.$id.'-%')->where('active', $this::ACTIVE)->count() > 0) {
			return true;
		}
		return false;
	}
}
