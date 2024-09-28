<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
    public function uploadImage($image, string $directory)
    {
        $imageName = $image->hashName();
        $path = '/uploads' . '/' . $directory . '/' . $imageName;
        $image = Image::make($image)->save(public_path($path), 100);
        return $imageName;
    }
    public function uploadImageS3($image, string $directory)
    {   $extension = $image->getClientOriginalExtension();
        $imageName = $image->hashName();
        $path = $directory . '/' . $imageName;
        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $image = Image::make($image)->encode();
            Storage::disk('s3')->put($path, $image);
        } elseif (in_array($extension, ['svg'])) {
            Storage::disk('s3')->put($path, file_get_contents($image));

        }



        return $path;
    }
    public function uploadImageAndResize($image, string $directory,  int $width = 400, int $height = null)
    {
        $imageName = $image->hashName();
        $path = '/uploads' . '/' . $directory . '/' . $imageName;
        Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path($path), 100);
        return $imageName;
    }

    public function uploadImageAndResizeS3($image, string $directory,  int $width = 400, int $height = null)
    {
        $imageName = $image->hashName();
        $path =  $directory . '/' . $imageName;
        $image = Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->encode();
        Storage::disk('s3')->put($path, $image);
        return $path;
    }
}
