<?php

namespace Nht\Http\Controllers\Api;

use Illuminate\Http\Request;
use Nht\Http\Controllers\Controller;

class EditorController extends Controller {

    /**
     * Browse image file
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function browse(Request $request)
    {
        return view('editor/browse');
    }

    /**
     * Upload image from ckeditor
     * @param  Request $request
     * @return string File name
     */
    public function upload(Request $request)
    {
        $uploaded = [
            'uploaded' => 0,
            'fileName' => null,
            'url' => '',
            'error' => [
                'message' => 'Upload không thành công.'
            ]
        ];

        // Upload Processing
        if ($request->hasFile('upload')) {
            $imageUploaded = $this->uploadImage();
            if ($imageUploaded['filename']) {
                $uploaded['uploaded'] = 1;
                $uploaded['url'] = $imageUploaded['url'];
                $uploaded['fileName'] = $imageUploaded['filename'];
                $uploaded['error']['message'] = '';
            } else {
                $uploaded['error']['message'] = $imageUploaded['message'];
            }
        }

        // Response json khi upload bằng drag & drop
        if ($request->get('responseType') == 'json') {
            return response()->json($uploaded);
        } else {
            $funcNum = $request->get('CKEditorFuncNum');
            $url = $uploaded['url'];
            $message = $uploaded['error']['message'];
            return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
        }
    }

    /**
     * Upload image
     * @return string File name
     */
    private function uploadImage()
    {
        $filename = '';
        $message = '';
        $configImage = \Config::get('image');
        $arrayResize = $configImage['array_resize_image'];

        // Process uploading
        try {
            $resultUpload = \App::make('ImageFactory')->upload('upload', PATH_UPLOAD_BLOG_THUMBNAIL, $arrayResize, 'resize');
            if ($resultUpload['status'] > 0) {
                $filename = $resultUpload['filename'];
            }
        } catch(Exception $e) {
            $message = $e->getMessage();
        }

        return [
            'filename' => $filename,
            'url' => PATH_BLOG_THUMBNAIL . $filename,
            'message' => $message
        ];
    }
}
