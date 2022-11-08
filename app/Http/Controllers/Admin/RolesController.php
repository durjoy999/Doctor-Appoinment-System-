<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolesStoreRequest;
use App\Http\Requests\RolesUpdateReqeust;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
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
     * Display all roles 
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('role.index')){
            abort(403,'Unauthorized access');
        }
        $data['roles'] = Role::with('permissions')->get();
        return view('admin.pages.roles.index',[
            'data' => $data
        ]);
    }
    /**
     * Show the form of creating new role
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('role.create')){
            abort(403,'Unauthorized access');
        }
        $data['permission_groups'] = Admin::getPermissionGroups();
        $data['permissions'] = DB::table('permissions')->get();
        return view('admin.pages.roles.create',[
            'data' => $data
        ]);
    }

    /**
     * Store the new role in 
     */
    public function store(RolesStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('role.store')){
            abort(403,'Unauthorized access');
        }
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'admin',
            'status' => $request->status
        ]);
        $permissions = $request->input('permissions');
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        } 

        return back()->with('role_and_permission_assign_success','Role and Permissions Create Successfully');

    }

    /**
     * Show the Edit form of a spcefic role
     */

     public function edit($id){
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort(403,'Unauthorized access');
        }
        $data['role'] = Role::with('permissions')->where('id',$id)->first();
        $data['permission_groups'] = Admin::getPermissionGroups();
        $data['permissions'] = DB::table('permissions')->get();
        return view('admin.pages.roles.edit',[
            'data' => $data
        ]);
     }

     /**
      * Update the Speceific role
      */
      public function update(RolesUpdateReqeust $request,$id){
        if(is_null($this->user) || !$this->user->can('role.update')){
            abort(403,'Unauthorized access');
        }
        $role = Role::findById($id);
        Role::where('id',$id)->update([
            'name' => $request->name,
            'guard_name' => 'admin',
            'status' => $request->status
        ]);
        $permissions = $request->input('permissions');
        $role->syncPermissions($permissions);

        return back()->with('role_and_permission_update_success','Role and Permission Update Successfully');
      }

      /**
       * Destroy the specefic role
       */
      public function destroy($id){
        if(is_null($this->user) || !$this->user->can('role.destroy')){
            abort(403,'Unauthorized access');
        }
          $role = Role::findById($id,'admin');
          if(!is_null($role)){
              $role->delete();
          }

          return back()->with('role_and_permission_delete_success','Role and Permission Delete Succesfully');
      }

    
}
