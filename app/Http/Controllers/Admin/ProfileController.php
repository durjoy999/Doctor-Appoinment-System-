<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the authenticated user profile
     */
    public function index(){
        $admin = Admin::with('roles')->where('email',Auth::guard('admin')->User()->email)->first();
        return view('admin.pages.profile.index',[
            'admin' => $admin
        ]);
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (Hash::check($request->old_password,Auth::guard('admin')->User()->password)) {
            Admin::where('id',Auth::guard('admin')->User()->id)->update([
                'password' => Hash::make($request->password),
             ]);
             return back()->with('password_changed','Password Change Successfully');
         }
 
         return back()->with('password_not_match','Password does not match with previous Password');
    }


    /**
     * Update Genearl Information
     */
    public function update(Request $request){
        $admin = Admin::where('email',Auth::guard('admin')->User()->email)->first();
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins,email,'.$admin->id,
        ]);
        $imageService = new ImageService();
      
        $image_name = $admin->photo;
        $image_location = 'photo/profile/';
        if($request->hasFile('photo')){
            if($image_name != 'default_profile.jpg'){
                $imageService->delete($image_name,$image_location);
            }
            $image_name = $imageService->upload($request->name,$image_location,$request->file('photo'));
        }
        Admin::where('email',$admin->email)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $image_name,
        ]);

       return back()->with('profile_updated',"Profile Update Successfully");
    }
}
