<?php

namespace App\Http\Controllers\Api\V1\Qiniu;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;

class QiniuController extends BaseController
{
    public function base64Upload(Request $request){
        $base64_img = $request->input('imgBase64');

        preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $result);

        $type = $result[2];

        $img = base64_decode(str_replace($result[1], '', $base64_img));

        $disk = \Storage::disk('qiniu');
        $img_name = date('Y/m/d-H:i:s-') . uniqid() . '.' . $type;
        $filename = $disk->put($img_name, $img); //上传
        if (!$filename) {
            $this->error(422, '上传失败');
        }
        $url = $disk->getUrl($img_name);

        return $this->response->array(['url' => $url]);
    }
    public function upload(Request $request){
        $img=$request->file('image');
        $disk = \Storage::disk('qiniu');
        $img_name = date('Y/m/d-H:i:s-') . uniqid();
        $filename = $disk->put($img_name, $img); //上传
        if (!$filename) {
            $this->error(422, '上传失败');
        }
        $url = $disk->getUrl($filename);

        return $this->response->array(['url' => $url]);
    }
}
