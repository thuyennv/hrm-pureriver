<?php

namespace Nht\Hocs\Blogs;

use Nht\Hocs\Core\BaseRepository;
use Nht\Hocs\Tags\TagRepository;

/**
 * Class DbUserRepository.
 *
 * @author	AlvinTran
 */
class DbBlogRepository extends BaseRepository implements BlogRepository
{
	protected $model;
	protected $tag;

    /**
     * Constructor
     * @param Blog          $blog
     * @param TagRepository $tag
     */
	public function __construct(Blog $blog, TagRepository $tag)
	{
		$this->model = $blog;
		$this->tag = $tag;
	}

	/**
	 * get random name of file
	 * @param  string $filename file name
	 * @return string           random name
	 */
	public function getRandomName($filename)
	{
    	$strSecret   = '!@#$%^&*()_+QBGFTNKU' . time() . rand(111111,999999);
  		$filenameMd5 = substr(md5($filename . $strSecret),0,10);
  		return date('Y_m_d') . '_' . $filenameMd5 . '.' . $this->getExtension($filename);
   	}

    /**
     * Create a blog
     * @param  array|object $attributes
     * @return Bool
     */
    public function create($attributes)
    {
        // Upload avatar
        if (isset($attributes['image'])) {
            $attributes['image'] = $this->uploadImage();
        }

        $attributes['slug'] = removeTitle($attributes['title']);
        $attributes['user_id'] = \Auth::user()->id;
        $attributes['active'] = Blog::ACTIVE;

        $blog = $this->model->create($attributes);

        // Attach tags
        if (isset($attributes['tags'])) {
            $tags = $attributes['tags'];
            $this->saveTag($blog, $tags);
        }

        return $blog;
    }

    /**
     * Update blog
     * @param  int $id
     * @param  array|object $attributes
     * @return Bool
     */
    public function update($id, $attributes)
    {

        $blog = $this->getById($id);

        // Re-upload image
        if (isset($attributes['image'])) {
            $attributes['image'] = $this->uploadImage($blog->image);
        }

        $attributes['slug'] = removeTitle($attributes['title']);

        $blog->fill($attributes)->save();

        // Syncing tags
        if (isset($attributes['tags'])) {
            $tags = $attributes['tags'];
            $this->saveTag($blog, $tags);
        }

        return $blog;
    }

    /**
     * Delete blog
     * @param  int $id
     * @return Bool
     */
    public function delete($id)
    {
        $blog = $this->getById($id);

        // Remove tag
        $blog->tags()->sync([]);

        // Remove image
        $this->removeImage($blog->image);
        return $blog->delete();
    }

    /**
     * Upload image
     * @param  string $oldImage
     * @return file name
     */
    private function uploadImage($oldImage = '')
    {
        $fileName = '';
        $configImage = \Config::get('image');
        $arrayResize = $configImage['array_resize_image'];

        // Process uploading
        $resultUpload = \App::make('ImageFactory')->upload('image', PATH_UPLOAD_BLOG_THUMBNAIL, $arrayResize, 'resize');
        if ($resultUpload['status'] > 0) {
            // Unlink avatar cũ nếu có
            $this->removeImage($oldImage, array_keys($arrayResize));
            $fileName = $resultUpload['filename'];
        }
        return $fileName;
    }

    /**
     * Remove blog image
     * @param  string $image
     * @param  array  $resizeArr
     * @return void
     */
    private function removeImage($image, $resizeArr = [])
    {
        @unlink(PATH_UPLOAD_BLOG_THUMBNAIL . $image); // Original
        foreach ($resizeArr as $size) {
            @unlink(PATH_UPLOAD_BLOG_THUMBNAIL . $size . $image); // Resizes
        }
    }

	/**
	 * Save tags
	 * @param  Blog   $blog
	 * @param  array|string $arrTags chuỗi tag nhập vào (php,laravel,js)
	 */
	public function saveTag(Blog $blog, $arrTags)
	{
		$tags = is_string($arrTags) ? explode(',', $arrTags) : $arrTags;
		$tag_id = [];
		foreach ($tags as $key => $tag) {
			$getTag = $this->tag->getTagByName($tag);
			if(!$getTag && $tag) {
				$objTag['tag'] = $tag;
				$objTag['slug'] = removeTitle($tag);
				if($newTag = $this->tag->create($objTag)) {
					$tag_id[] = $newTag->id;
				}
			} else if($getTag && $tag) {
				$tag_id[] = $getTag->id;
			}
		}
		$blog->tags()->sync($tag_id);
	}

    /**
     * Get features blog
     * @param  integer $count
     * @return Collection
     */
	public function getFeatureBlogs($count = 5)
	{
		return $this->model->where('active', Blog::ACTIVE)
						->where('hot', Blog::HOT)
						->orderBy('created_at', 'DESC')
						->take($count)->get();
	}

    /**
     * [getAllByTagWithPaginate]
     * @param  [type]  $tagSlug
     * @param  integer $pageSize
     * @return [type]
     */
	public function getAllByTagWithPaginate($tagSlug, $pageSize = 20)
	{
		$tag = $this->tag->getTagBySlug($tagSlug);
		$listBlog = [];
		foreach ($tag->blogs as $blog) {
			$listBlog[] = $blog->id;
		}
		return $this->model->whereIn('id', $listBlog)
						->where('blogs.active', Blog::ACTIVE)
						->orderBy('blogs.created_at', 'DESC')
						->paginate($pageSize);
	}

    /**
     * [getAllByCatWithPaginate]
     * @param  [type]  $catId
     * @param  integer $pageSize
     * @return [type]
     */
	public function getAllByCatWithPaginate($catId,  $pageSize = 20)
	{
		return $this->model->where('category_id', $catId)
	                   	->where('blogs.active', Blog::ACTIVE)
						->orderBy('blogs.created_at', 'DESC')
						->paginate($pageSize);
	}

    /**
     * [getAllByAutWithPaginate]
     * @param  [type]  $autId
     * @param  integer $pageSize
     * @return [type]
     */
	public function getAllByAutWithPaginate($autId,  $pageSize = 20)
	{
		return $this->model->where('user_id', $autId)
		                ->where('blogs.active', Blog::ACTIVE)
						->orderBy('blogs.created_at', 'DESC')
						->paginate($pageSize);
	}

    /**
     * [getLQ]
     * @param  [type] $category_id
     * @return [type]
     */
	public function getLQ($category_id)
	{
		return $this->model->where('active', Blog::ACTIVE)
					 ->where('category_id', $category_id)
					 ->orderBy('created_at', 'DESC')
					 ->take(5)->get();
	}

    /**
     * Get extension
     * @param  string $filename
     * @return extension
     */
    private function getExtension($filename)
    {
        return explode('.', $filename)[1];
    }
}
