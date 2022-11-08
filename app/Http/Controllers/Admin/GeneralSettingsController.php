<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralSettingsUpdateRequest;
use App\Models\GeneralSettings;
use App\Repositories\SettingsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralSettingsController extends Controller
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
     * Show the general settings form
     */
    public function generalSettings(){
        if(is_null($this->user) || !$this->user->can('generalSettings.index')){
            abort(403,'Unauthorized access');
        }
        $generalSettings = GeneralSettings::latest()->first();
        return view('admin.pages.settings.general_settings',[
            'generalSettings' => $generalSettings
        ]);
    }

    /**
     * Update the general settings 
     */
    public function generalSettingsUpdate(GeneralSettingsUpdateRequest $request,$id,SettingsRepository $settingsRepositoy){
        if(is_null($this->user) || !$this->user->can('generalSettings.update')){
            abort(403,'Unauthorized access');
        }
        $settingsRepositoy->generalSettingsUpdate($request,$id);
        return back()->with('general_settinigs_update_success','General Settings Update Successfully');
    }
}
