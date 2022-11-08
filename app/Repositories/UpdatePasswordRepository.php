<?php
namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class UpdatePasswordRepository{
    /**
     * @param request data
     */
    public function update($requestData){
      
      
       $data =  DB::table('password_resets')->whereRaw('email = ?',$requestData->email)->whereRaw('token = ?',$requestData->token)->first();
       
        if(!$data){
            return redirect('/admin/login')->with('something_wrong','Something wrong please try again!!');     
        }
        else{
            $admin = Admin::where('email',$data->email)->first();
            $admin->password = $admin->passwordEncrypt($requestData->password);
            $admin->save();
            return back();
            
        }
    }
}