<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    function avatar(Request $request)
    {
        $uploaded_images = $request->file("images");
        $dir = "avatar";
        $size = 256;
        $images = $this->uploadFiles($dir,$uploaded_images);
        $images = $this->resizeImages($images,$dir,$size);
        return $this->response($images);
    }

    function lesson(Request $request)
    {
        $uploaded_images = $request->file("images");
        $images = $this->uploadFiles("lesson",$uploaded_images);
        return $this->response($images);
    }

    function resizeImages($images,$dir,$size){
        foreach ($images as &$image){
            $path = explode("/",$image);
            $file_name = array_pop($path);
            $image_file_name = $dir."/".$file_name;
            $image_file = Storage::disk("public")->get($image_file_name);
            $img = Image::make($image_file);
            $resize = $this->imageResize($img,$size);
            if($resize){
                Storage::disk("public")->put($dir."/".$file_name,$resize);
            }
            $image = $resize ? $image : false;
        }
        return $images;
    }

    function imageResize(\Intervention\Image\Image $image,$size){
        $w = $image->width();
        $h = $image->height();
        if($w < $size || $h < $size){
            return false;
        }
        if($w < $h){
            $nw = $size;
            $nh = intval($h*$size/$w);
            return $image->resize($nw,$nh)->encode();
        }else{
            $nh = $size;
            $nw = intval($w*$size/$h);
            return $image->resize($nw,$nh)->encode();
        }
    }

    function diploma(Request $request)
    {
        $uploaded_images = $request->file("images");
        $images = $this->uploadFiles("diploma",$uploaded_images);
        return $this->response($images);
    }

    private function uploadFiles($dir, $images)
    {
        $arr = [];
        foreach ($images as $image) {
            $img = Storage::disk("public")->put($dir, $image);
            $arr[] = URL::asset("public/images/".$img);
        }
        return $arr;
    }
}
