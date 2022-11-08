<?php
namespace App\Repositories;

use App\Models\Admin;
use App\Services\ImageService;
use Illuminate\Support\Facades\Hash;

class AdminRepository{
    /**
     * Save the resource in database
     * @param $adminData;
     * @return App\Models\Admin;
     */
    public function create($adminData){

        $imageService = new ImageService();
        $imageName = 'default_profile.jpg';
        $imageLocation = 'photo/profile/';

        $admin = new Admin();
        $admin->name = $adminData->name;
        $admin->email = $adminData->email;
        $admin->password = $admin->passwordEncrypt($adminData->password);
        $admin->status = $adminData->status;

        if ($adminData->hasFile('photo')) {
            $imageName = $imageService->upload($adminData->name,$imageLocation,$adminData->file('photo'));
        }

        $admin->photo = $imageName;
        $admin->save();
        return $admin;

    }


    /**
     * Update the specefic resourece
     * @param $adminData, $id
     * @return App\Models\Admin; 
     */
    public function update($adminData,$id){
        $admin = Admin::where('id',$id)->first();
        $admin->status = $adminData->status;
        $admin->save();
        return $admin;
    }
}