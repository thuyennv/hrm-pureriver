<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Nht\Http\Controllers\Admin\AdminController;
use Nht\Hocs\Pages\PageRepository;

class PageController extends AdminController
{
    /**
     * Page
     */
    protected $page;

    /**
     * Constructor
     * @param PageRepository $page
     */
    public function __construct(PageRepository $page)
    {
        $this->page = $page;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->setFilter($request, 'name', 'LIKE');
        $this->setFilter($request, 'type', '=', 0);
        $this->setFilter($request, 'active', '=', 1);
        $pages = $this->page->getAll($this->getFilter(), $this->getSorter($request), 25);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($page = $this->page->create($request->all())) {
            return $this->redirectOk('page.index', 'Tạo trang thành công.');
        }
        return $this->redirectFail('Tạo trang thất bại');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
