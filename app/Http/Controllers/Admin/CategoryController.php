<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Nht\Http\Controllers\Admin\AdminController;
use Nht\Hocs\Categories\Category;
use Nht\Hocs\Categories\CategoryRepository;
use Nht\Http\Requests\AdminCategoryRequest;
use Illuminate\Support\Collection;

/**
 * Class CategoryController.
 *
 * @author  SaturnLai
 */

class CategoryController extends AdminController
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->setFilter($request, 'email', '=');
        $filter = $this->getFilter();
        $sorter = $this->getSorter($request);
        $list = $this->category->getAll($filter, $sorter, 25)->toArray();
        $category = $this->category->getAllWithSort(Collection::make($list['data']));
        return view('admin/categories/index', compact('category'));
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
        return view('/admin/categories/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(AdminCategoryRequest $request)
    {
        if ($this->category->create($request->all())) {
            return $this->redirectOk('category.index', 'Tạo mới danh mục thành công');
        }
        return $this->redirectFail('Có lỗi xảy ra, vui lòng thử lại sau');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->category->getById($id);
        $list = $this->category->getAll();
        $categories = $this->category->getAllWithSort($list);
        return view('admin/categories/edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, AdminCategoryRequest $request)
    {
        if ($this->category->update($id, $request->all()))
        {
            return $this->redirectOk('category.index', 'Cập nhật danh mục thành công');
        }
        return $this->redirectFail('Có lỗi xảy ra, vui lòng thử lại sau');
    }

    /**
     * Update the active category in storage
     * @param  int  $id
     * @return Response
     */

    public function active($id)
    {
        if ($this->category->active($id)) {
            $category = $this->category->getById($id);
            return [
                'code'   => 1,
                'status' => $category->getStatus()
            ];
        } else {
            return [
                'code'   => 0,
                'message' => 'Không thể kích hoạt danh mục này! Vui lòng thử lại.'
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->category->delete($id)) {
            return $this->redirectOk('category.index', 'Xóa thành công danh mục');
        }
        return $this->redirectOk('category.index', 'Có lỗi xảy ra, xóa danh mục không thành công.', 'error');
    }
}
