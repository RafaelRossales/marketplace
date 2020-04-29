<?php 
namespace App\Traits;


trait UploadTrait
{
    private function imageUpload($images, $imageColumn = null)
    {
        $uploadImages = [];

        if(is_array($images)){
            
            foreach($images as $image)
            {
                if (!is_null($imageColumn)){
                    $uploadImages[] = [$imageColumn => $image->store('product','public')];
                }
            }
        }else{
            $uploadImages = $images->store('logo','public');
        }

        return $uploadImages;
    }
}