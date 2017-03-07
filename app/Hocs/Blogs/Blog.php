<?php

namespace Nht\Hocs\Blogs;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * Kinds of blog
     */
    const REGULAR = 0;
    const MODULE = 1;

    /**
     * Blog status
     */
    const INACTIVE = 0;
    const ACTIVE = 1;

    /**
     * Feature blogs
     */
    const HOT = 1;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'title', 'teaser', 'image', 'content', 'active', 'hot', 'category_id', 'user_id', 'slug'
    ];

    public function page()
    {
        return $this->belongsToMany(Nht\Hocs\Pages\Page::class, 'blog_page');
    }

    /**
     * Get tags
     */
    public function tags() {
        return $this->belongsToMany(\Nht\Hocs\Tags\Tag::class, 'blog_tag', 'blog_id');
    }

    /**
     * [category description]
     * @return [type] [description]
     */
    public function category() {
        return $this->belongsTo('Nht\Hocs\Categories\Category', 'category_id');
    }

    /**
     * [author description]
     * @return [type] [description]
     */
    public function author() {
        return $this->belongsTo('Nht\Hocs\Users\User', 'user_id');
    }

    /**
     * [getThumbnail description]
     * @param  string $resize [description]
     * @return [type]         [description]
     */
    public function getThumbnail($resize = '') {
    	return $this->image != null ? PATH_BLOG_THUMBNAIL.$resize.$this->image : '/images/default.png';
    }

    /**
     * [getUrl description]
     * @return [type] [description]
     */
    public function getUrl() {
        return route('frontend.blog', [$this->id, $this->slug]);
    }

    /**
     * [getHot description]
     * @return [type] [description]
     */
    public function getHot() {
        return $this->hot;
    }

    /**
     * [getActive description]
     * @return [type] [description]
     */
    public function getActive() {
        return $this->active;
    }

    /**
     * Get tag with link
     * @return [type] [description]
     */
    public function getTags() {
        $tag_list = [];
        foreach($this->tags as $tag) {
            $tag_list[] = '<a style="display: inline-block; margin: 0 5px;" href="/tags/'.$tag->slug.'" class="tag-content">'.$tag->tag.'</a>';
        }
        return implode('', $tag_list);
    }

    /**
     * Get string tag
     * @return [type] [description]
     */
    public function getStringTags()
    {
        $tag_list = [];
        foreach($this->tags as $tag) {
            $tag_list[] = $tag->tag;
        }
        return implode(',', $tag_list);
    }

    /**
     * Lấy checked của checkbox của blog hot
     * @return string
     */
    public function showCheckHot() {
        echo $this->getHot() ? '<i class="fa fa-2x fa-check-square"></i>' : '<i class="fa fa-2x fa-square-o"></i>';
        return false;
    }

    /**
     * Lấy checked của checkbox của blog đã active
     * @return string
     */
    public function showCheckActive() {
        echo $this->getActive() ? '<i class="fa fa-2x fa-check-square"></i>' : '<i class="fa fa-2x fa-square-o"></i>';
        return false;
    }
}
