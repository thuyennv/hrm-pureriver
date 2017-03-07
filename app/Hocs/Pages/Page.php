<?php

namespace Nht\Hocs\Pages;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * Kiểu page
     */
    const SINGLE = 0;
    const LIST = 1;
    const MODULE = 2;

    /**
     * Trạng thái
     */
    const INACTIVE = 0;
    const ACTIVE = 1;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    public $fillable = [
        'name', 'slug', 'type', 'active', 'meta_title', 'meta_keyword', 'meta_description'
    ];

    /**
     * Get menu
     */
    public function menu()
    {
        return $this->belongsTo(\Nht\Hocs\Menus\Menu::class);
    }

    /**
     * Get blogs
     */
    public function blogs()
    {
        return $this->belongsToMany(\Nht\Hocs\Blogs\Blog::class, 'blog_page');
    }

    /**
     * Get type presentation
     * @param  int $type
     * @return string
     */
    public function getType($type = null)
    {
        $typeList = [
            0 => 'Trang tĩnh',
            1 => 'Danh sách',
            2 => 'Module',
        ];
        $type = (int) $type == null ? $this->type : $type;
        return $typeList[$type] ? $typeList[$type] : 'Unknown';
    }

    /**
     * Get status presentation
     * @param  int $status
     * @return string
     */
    public function getStatus($status = null)
    {
        $status = (int) $status == null ? $this->status : $status;
        echo $status ? '<i class="fa fa-2x fa-check-square-o"></i>' : '<i class="fa fa-2x fa-check-square"></i>';
        return false;
    }
}
