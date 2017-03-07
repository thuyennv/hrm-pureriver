<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Nht\Hocs\Blogs\Blog;
use Nht\Hocs\Blogs\BlogRepository;
use Nht\Hocs\Categories\Category;
use Nht\Hocs\Categories\CategoryRepository;
use Nht\Hocs\Users\UserRepository;
use Nht\Http\Controllers\Admin\AdminController;
use Nht\Http\Requests\AdminBlogFormRequest;
use Illuminate\Support\Collection;

class BlogController extends AdminController {

    protected $blog;
    protected $category;

    public function __construct(
        UserRepository $user,
        BlogRepository $blog,
        CategoryRepository $category)
    {
        $this->user = $user;
        $this->blog = $blog;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // filter
        $this->setFilter($request, 'title', 'LIKE');
        $this->setFilter($request, 'category_id', '=');
        $this->setFilter($request, 'active', '=');
        $this->setFilter($request, 'type', '=');
        $filter = $this->getFilter();

        $sorter = $this->getSorter($request);

        $blogs = $this->blog->getAll($filter, $sorter, 25);
        $list = $this->category->getAll();
        $categories = $this->category->getAllWithSort($list);
        return view('admin/blogs/index', compact('blogs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $list = $this->category->getAll();
        $categories = $this->category->getAllWithSort($list);
        return view('admin/blogs/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(AdminBlogFormRequest $request)
    {
        if ($this->blog->create($request->all())) {
            return $this->redirectOk('blog.index', trans('general.messages.create_success'));
        }
        return $this->redirectFail(trans('general.messages.create_fail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $blog = $this->blog->getById($id);
        $list = $this->category->getAll();
        $categories = $this->category->getAllWithSort($list);
        return view('admin/blogs/edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, AdminBlogFormRequest $request)
    {
        if ($this->blog->update($id, $request->all())) {
            return $this->redirectOk(['blog.edit', $id], trans('general.messages.update_success'));
        }
        return $this->redirectFail(trans('general.messages.create_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->blog->delete($id))
        {
            return $this->redirectOk('blog.index', trans('general.messages.delete_success'));
        }
        return $this->redirectOk('blog.index', trans('general.messages.delete_fail'), 'error');
    }

    /**
     * Active blog
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function active($id) {
        $blog = $this->blog->getById($id);
        $blog->active = !$blog->active;
        if($blog->save()) {
            return [
                'code' => 1,
                'messages' => 'Cập nhật thành công',
                'status' => $blog->active
            ];
        }
        return ['code' => 0, 'messages' => 'Cập nhật thất bại'];
    }

    /**
     * Check hot blog
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function hot($id) {
        $blog = $this->blog->getById($id);
        $blog->hot = !$blog->hot;
        if($blog->save()) {
            return [
                'code' => 1,
                'messages' => 'Cập nhật thành công',
                'status' => $blog->hot
            ];
        }
        return ['code' => 0, 'messages' => 'Cập nhật thất bại'];
    }
}
