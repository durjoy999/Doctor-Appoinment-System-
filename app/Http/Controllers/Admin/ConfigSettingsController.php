<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigSettingsUpdateRequest;
use App\Repositories\SettingsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ConfigSettingsController extends Controller
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
     * Show Config Settings form
     */
    public  function configSettings(){
        if(is_null($this->user) || !$this->user->can('configSettings.index')){
            abort(403,'Unauthorized access');
        }
        $data['app_name'] = config('app.name', 'Laravel');
        $data['app_env'] = config('app.env', 'production');
        $data['app_debug'] = config('app.debug', 'false');
        $data['app_url'] = config('app.url', 'false');
        $data['db_database'] = config('app.db_database', 'laravel');
        $data['db_username'] = config('app.db_username', 'root');
        $data['db_password'] = config('app.db_password', '');
        $data['mail_mailer'] = env('MAIL_MAILER');
        $data['mail_host'] = env('MAIL_HOST');
        $data['mail_port'] = env('MAIL_PORT');
        $data['mail_username'] = env('MAIL_USERNAME');
        $data['mail_password'] = env('MAIL_PASSWORD');
        $data['mail_encription'] = env('MAIL_ENCRYPTION');
        $data['mail_from_address'] = env('MAIL_FROM_ADDRESS');
        return view('admin.pages.settings.config_settings',[
            'data' => $data
        ]);
    }

    /**
     * optimize clear Settings update
     */
    public function optimizeClear(){
        if(is_null($this->user) || !$this->user->can('configSettings.optimizeClear')){
            abort(403,'Unauthorized access');
        }
        Artisan::call('optimize:clear');
        
        return back()->with('optimize_clear','Optimize Clear Successfully Done');
    }
    /**
     * Application optimize
     */
    public function optimize(){
        if(is_null($this->user) || !$this->user->can('configSettings.optimize')){
            abort(403,'Unauthorized access');
        }
        Artisan::call('optimize');
        
        return back()->with('optimize','Optimize Successfully Done');
    }

}
