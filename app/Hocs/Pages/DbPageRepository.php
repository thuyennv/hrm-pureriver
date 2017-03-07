<?php

namespace Nht\Hocs\Pages;

use Nht\Hocs\Core\BaseRepository;

class DbPageRepository extends BaseRepository implements PageRepository {

    /**
     * Page
     */
    protected $model;

    /**
     * Constructor
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    /**
     * Create page
     * @param  [type] $attributes [description]
     * @return [type]             [description]
     */
    public function create($attributes)
    {
        $slug = removeTitle($attributes['name']);
        $attributes['slug'] = $slug;
        $page = $this->model->create($attributes);
        return $page;
    }

    /**
     * Toggle active page
     * @param  int $id
     * @return bool
     */
    public function active($id)
    {
        $page = $this->getById($id);
        $page->active = ! $page->active;
        return $page->save();
    }
}
