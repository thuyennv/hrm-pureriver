<?php

namespace Nht\Http\Controllers\Api;

use Illuminate\Http\Request;
use Nht\Http\Controllers\Controller;
use Nht\Hocs\Tags\TagRepository;

class TagController extends Controller {

    /**
     * lấy mảng tag với search LIKE từ khóa nhập vào term
     * @param  TagRepository $tag [description]
     * @return [type]             [description]
     */
    public function getTags(TagRepository $tag, Request $request) {
        $response = [];
        $query = removeTitle($request->get('term'));
        $tags = $tag->searchTag($query);
        foreach ($tags as $key => $t) {
            $ojbTag['label'] = $t->tag;
            $objTag['value'] = $t->tag;
            $response[] = $objTag;
        }
        return json_encode($response);
    }
}
