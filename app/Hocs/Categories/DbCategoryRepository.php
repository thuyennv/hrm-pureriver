<?php

namespace Nht\Hocs\Categories;

use Nht\Hocs\Core\BaseRepository;
use Nht\Hocs\Categories\Category;
use Illuminate\Database\DatabaseManager as DBM;
use Illuminate\Support\Collection;

class DbCategoryRepository extends BaseRepository implements CategoryRepository
{

    protected $db;
    protected $model;
    protected $html = '&rarr; ';
    protected $maskData = [];
    protected $maskDataHeader = '';
    protected $pathName = '-';

    /**
     * [__construct description]
     * @param Category $model [description]
     * @param DBM      $db    [description]
     */
    public function __construct(Category $model, DBM $db) {
        $this->db             = $db;
        $this->model          = $model;
    }

    /**
     * [getAllWithSort description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function getAllWithSort($data)
    {
        $this->sort($data, 0, false);
        return $this->maskData;
    }

    /**
     * Hàm lấy tất cả các danh mục
     * @param  boolean $list   default: false
     * @param  array   $params Mảng điều kiện cần lấy
     * @return array
     */
    public function getListCategories($list = true, array $params = array()) {

        $slug = array_get($params, 'name');
        $data = $this->model->orderBy('created_at', 'DESC');

        if ($slug) {
            $data->where('slug', removeTitle($slug));
        }
        $data = $data->get();
        $this->sort($data, 0, $list);
        return $this->maskData;
    }

    /**
     * [getHeaderCategories description]
     * @param  boolean $list       [description]
     * @param  array   $conditions [description]
     * @return [type]              [description]
     */
    public function getHeaderCategories($list = true, $conditions = array())
    {
        $data = $this->model->where('active', Category::ACTIVE);

        if (!empty($conditions)) {
            foreach ($conditions as $key => $val) {
                $data = $data->where($key, $val);
            }
        }
        $data = $data->orderBy('created_at', 'DESC')->get();
        $this->sortHeader($data, 0, $list);
        return $this->maskDataHeader;
    }

    /**
     * [create description]
     * @param  [type] $attributes [description]
     * @return [type]             [description]
     */
    public function create($attributes)
    {
        $parent_id            = (int) $attributes['parent_id'];
        $attributes['level']  = 1;
        $attributes['active'] = (int) Category::ACTIVE;
        $attributes['slug']   = removeTitle($attributes['name']);
        $category             = $this->model->create($attributes);

        if ($category) {
            $path = $this->pathName . $category->id . $this->pathName;
            if (isset($parent_id) && $parent_id > 0) {
                if ($parent = $this->getById($parent_id)) {
                    $path            = $parent->path . $path;
                    $tmp             = explode($this->pathName, $path);
                    $category->level = (int)(count($tmp) - 1) / 2;
                }
            }
            $category->path = $path;
            $category->save();
        }
        return $category;
    }

    /**
     * [update description]
     * @param  [type] $id         [description]
     * @param  [type] $attributes [description]
     * @return [type]             [description]
     */
    public function update($id, $attributes)
    {
        $category = $this->getById($id);
        $parent_id = (int) $attributes['parent_id'];
        $attributes['slug'] = removeTitle($attributes['name']);

        if ($parent_id != $category->parent_id) {
            $parent = $this->getById($parent_id, false);
            if ($parent) {
                if (strpos($parent->path, $category->path) === false
                    || strpos($this->pathName . $parent->id . $this->pathName, $category->path) === false)
                {
                    $attributes['path'] = $parent->path . $this->pathName . $category->id . $this->pathName;
                    $tmp = explode($this->pathName, $attributes['path']);
                    $level = (int) (count($tmp) - 1) / 2 - $category->level;
                    $this->db->table('categories')->where('path', 'LIKE', $category->path . '%')
                    ->update([
                        'level' => $this->db->raw('`level` + ' . $level),
                        'path'  => $this->db->raw('REPLACE(`path`, \'' . $category->path . '\', \'' . $attributes['path'] . '\')')
                    ]);
                }
            } else {
                $attributes['parent_id'] = 0;
                $attributes['path']      = $this->pathName . $category->id . $this->pathName;
                $attributes['level']     = 1;
            }
        }
        $category->fill($attributes)->save();
        return $category;
    }


    /**
     * Hàm đệ quy để lấy ra danh mục
     * @param  [type]  $data   [description]
     * @param  integer $parent [description]
     * @param  boolean $list   [description]
     * @return [type]          [description]
     */
    public function sort($data, $parent = 0, $list = true)
    {
        if (!empty($data)) {
            foreach ($data as $key => $category) {
                if ($category['parent_id'] == $parent) {
                    $category['mask'] = ($category['level'] <= 1) ? $category['name'] : '|' . str_repeat($this->html, $category['level'] - 1) . $category['name'];
                    if ($list) {
                        $this->maskData[$category['id']] = $category['mask'];
                    } else {
                        array_push($this->maskData, $category);
                    }
                    $this->sort($data, $category['id'], $list);
                }
            }
        }
    }

    /**
     * [sortHeader description]
     * @param  [type]  $data   [description]
     * @param  integer $parent [description]
     * @param  boolean $list   [description]
     * @param  boolean $ul     [description]
     * @param  integer $level  [description]
     * @return [type]          [description]
     */
    public function sortHeader($data, $parent = 0, $list = true, $ul = false, $level = 1) {
        if (!empty($data)) {
            if ($ul) {
                if($level > 2) {
                    $this->maskDataHeader .= '<ul class="dropdown-menu dropdown-menu-x">';
                } else if($level > 1) {
                    $this->maskDataHeader .= '<ul class="dropdown-menu">';
                }
            }

            foreach ($data as $key => $category) {
                if ($category->parent_id == $parent) {
                    $this->maskDataHeader .= '<li class="';
                    if ($category->getCountByParent() > 0) {
                        $this->maskDataHeader .= 'dropdown ';
                    }
                    if ($category->checkUrl(explode("-", Request::segment(2))[0], $category->id)) {
                        $this->maskDataHeader .= 'active ';
                    }
                    $this->maskDataHeader .= '"><a href="'.$category->getUrlCat().'" class="dropdown-hover">'.$category->name;
                    if ($category->level <= 1 && $category->getCountByParent() > 0) {
                        $this->maskDataHeader .= '<span class="caret"> </span> ';
                    } else if ($category->level > 1 && $category->getCountByParent() > 0) {
                        $this->maskDataHeader .= '<span class="caret-x"> </span> ';
                    }
                    $this->maskDataHeader .= '</a>';

                    if ($category->getCountByParent() > 0) {
                        $this->sortHeader($data, $category->id, $list, true, $level+1);
                    } else {
                        $this->sortHeader($data, $category->id, $list, false, $level+1);
                    }

                    $this->maskDataHeader .= '</li>';
                }
            }

            if ($ul) {
                if ($level > 1) {
                    $this->maskDataHeader .= '</ul>';
                }
            }
        }
    }

    /**
     * Thực thi xóa dữ danh mục đồng thời cập nhập lại level và path cho danh mục
     * @param  Category $category [ Đối tượng cần xóa]
     */
    public function removeCategory(Category $category)
    {
        $this->model->where('path', 'LIKE', $category->path . '%')->update([
            'parent_id' => 0,
            'level'     => $this->db->raw('`level` - 2 '),
            'path'      => $this->db->raw('REPLACE(`path`, \'' . $category->path . '\', \'\')')
        ]);

        return $this->model->where('id', $category->id)->delete();
    }

    /**
     * Lấy ra danh mục theo slug
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function getCategoryBySlug($slug) {
        return $this->model->where('slug', $slug)->where('active', Category::ACTIVE)->first();
    }

    /**
     * Toggle active status
     * @param  Categories $categories
     * @return Categories
     */
    public function active($id) {
        $category = $this->getById($id);
        $category->active = !$category->active;
        return $category->save();
    }

}
