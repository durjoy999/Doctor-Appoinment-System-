<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AwardsRecord;
use App\Models\EducationalQualification;
use App\Models\MakeAppointment;
use App\Models\WhichHospital;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $superAdmin = Admin::count();
        $MakeAppointment = MakeAppointment::count();
        $WhichHospital = WhichHospital::count();
        $EducationalQualification = EducationalQualification::count();
        $AwardsRecord = AwardsRecord::count();
        return view('admin.pages.home.index',[
            'superAdmin' => $superAdmin,
            'MakeAppointment' => $MakeAppointment,
            'WhichHospital' => $WhichHospital,
            'EducationalQualification' => $EducationalQualification,
            'AwardsRecord' => $AwardsRecord
        ]);
    }
}
