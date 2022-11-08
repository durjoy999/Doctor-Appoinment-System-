<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;

class AdminController extends Controller
{
    /**
     * Construct method
     */
    public $user;
    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
    }
    /**
     * List of all admins
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('admin.index')){
            abort(403,'Unauthorized access');
        }
        $data['admins'] = Admin::with('roles')->get();
        return view('admin.pages.admin.index',[
            'data' => $data
        ]);
    }   

    /**
     * Show the form of creating new admins
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403,'Unauthorized access');
        }
        $data['roles'] = $this->roles();
        return view('admin.pages.admin.create',[
            'data' => $data
        ]);
    }
    /**
     * Store a new admin information
     */
    public function store(AdminStoreRequest $request, AdminRepository $adminRepository){
        if(is_null($this->user) || !$this->user->can('admin.store')){
            abort(403,'Unauthorized access');
        }
        $admin = $adminRepository->create($request);
        $admin->assignRole($request->role);
        return back()->with('admin_add_success','Admin added Successfully');
     }

    /**
     * Show the from of specifice admin information
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403,'Unauthorized access');
        }
        $data['roles'] = $this->roles();
        $data['admin'] = $this->admin($id);
        return view('admin.pages.admin.edit',[
            'data' => $data
        ]);
    }
    /**
     * 
     * Update a specefic admin information
     * 
     */
    public function update(AdminUpdateRequest $request,$id,AdminRepository $adminRepository){
        if(is_null($this->user) || !$this->user->can('admin.update')){
            abort(403,'Unauthorized access');
        }
        $data['admin'] = $adminRepository->update($request,$id);
        $data['admin']->syncRoles([$request->role]);
        return back()->with('admin_update_success','Admin Update Successfully');
    }
    /**
     * Destroy a specefic admin 
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('admin.destroy')){
            abort(403,'Unauthorized access');
        }
        $data['admin'] = $this->admin($id);
        $data['admin']->roles()->detach();
        $data['admin']->delete();
        return back();
    }


    /**
     * This function return specifice admin
     */
    public function admin($id){
       return Admin::with('roles')->where('id',$id)->first();
    }

    /**
     * This function return all roles
     */
    public function roles(){
        return DB::table('roles')->get();
    }
}
