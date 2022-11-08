<?php
namespace App\Services;
class ImageService {
    /**
     * upload image in desire location with desire name
     * @param $name, $location, $photo
     * @return $name
     */
    public function upload($name,$location,$photo){
        $new_name = $name.rand(11,99).'.'.$photo->getClientOriginalExtension();
        $destination = public_path($location);
        $photo->move($destination,$new_name);
        return $new_name;
    }

    /**
     * delete image from desire location
     * @param $name, $location
     */
    public function delete($name,$location){
        unlink(public_path($location).$name);
        return back();
    }
}