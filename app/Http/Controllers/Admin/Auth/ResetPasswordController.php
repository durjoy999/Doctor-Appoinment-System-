<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Providers\RouteServiceProvider;
use App\Repositories\UpdatePasswordRepository;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{

    /**
     * Show the form of updating password
     */
    public function index($token){
        $data['reset_data'] = DB::table('password_resets')->whereRaw('token = ?',$token)->first();
        if(!$data['reset_data']){
            return redirect('/admin/login')->with('password_reset_time_out','Your Password Reset link Expired');
        }
        return view('admin.auth.passwords.reset',[
            'data' => $data
        ]);
    }

    /**
     * Update requested user password if token match
     */
    public function update(UpdatePasswordRequest $request,UpdatePasswordRepository $updatePasswordRepository){
        $updatePasswordRepository->update($request);
        DB::table('password_resets')->whereRaw('email = ?',$request->email)->delete();
        return redirect('/admin/login')->with('password_updated_success','Password Update Successfully');
    }


    
}
