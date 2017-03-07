<?php

namespace Nht\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Nht\Http\Controllers\Frontend\FrontendController;

use Nht\Hocs\Blogs\BlogRepository;
use Nht\Hocs\Categories\CategoryRepository;
use Nht\Hocs\Tags\TagRepository;
use Nht\Hocs\Blogs\Blog;

class BlogController extends FrontendController
{
    protected $tag;
    protected $blog;
    protected $category;

    /**
     * Constructor
     * @param BlogRepository     $blog
     * @param CategoryRepository $category
     * @param TagRepository      $tag
     */
	public function __construct(
        BlogRepository $blog,
        CategoryRepository $category,
        TagRepository $tag)
	{
        parent::__construct();
        $this->blog     = $blog;
        $this->category = $category;
        $this->tag      = $tag;
	}

    /**
     * Trang chủ
     * @return View
     */
    public function index(Request $request)
    {
        $filter = [['active', '=', 1]];
        $blogs = $this->blog->getAll($filter, false, 25);
        $features = $this->blog->getFeatureBlogs(3);
        return view('frontend/blog_list', compact('blogs', 'features'));
    }

    /**
     * Trang chi tiết
     * @param  int $id
     * @return View
     */
    public function show($id) {
    	$blog = $this->blog->getById($id);
        $this->metadata->setMetaTitle($blog->title);
        $this->metadata->setDescription($blog->teaser);
        $this->metadata->setMetaKeyWord($blog->tags);
    	return view('frontend.blog', compact('blog'));
    }

    /**
     * Tag
     * @param  string $slug
     * @return View
     */
    public function getTags($slug) {
        $tag = $this->tag->getTagBySlug($slug);
        $blogs = $this->blog->getAllByTagWithPaginate($slug);
        //Metadata
        $this->metadata->setMetaTitle($tag->tag);
        $this->metadata->setDescription('Các blog với tag ' . $tag->tag);
        $this->metadata->setMetaKeyWord($tag->tag);
        return view('frontend.index', compact('blogs'));
    }

    /**
     * Category
     * @param  int $category
     * @return View
     */
    public function category($category) {
        $cat = $this->category->getById($category);
        if($cat->active == Blog::ACTIVE)  {
            $blogs = $this->blog->getAllByCatWithPaginate($category);
        } else {
            $blogs = [];
        }

        //Metadata
        $this->metadata->setMetaTitle($cat->name);
        $this->metadata->setDescription('Các blog của danh mục '.$cat->name);
        $this->metadata->setMetaKeyWord($cat->name);
        return view('frontend.index', compact('blogs'));
    }

    public function recruitment(Request $request)
    {
        $segment = isset($request) ? $request->segment(1) : 'tuyen-dung';
        $category = $this->category->getCategoryBySlug($segment);
        $blogs = $this->blog->getAllByCatWithPaginate($category->id);
        return view('frontend/recruitment', compact('blogs'));
    }
}
