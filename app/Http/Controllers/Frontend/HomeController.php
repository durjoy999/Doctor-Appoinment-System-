<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AwardsRecord;
use App\Models\DoctorMyself;
use App\Models\doctorPhoto;
use App\Models\EducationalQualification;
use App\Models\MakeAppointment;
use App\Models\WhichHospital;
use App\Models\GeneralSettings;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $doctorPhotos = doctorPhoto::where('status', 'Active')->first();
        $DoctorMyselfs = DoctorMyself::where('status', 'Active')->first();
        $EducationalQualifications =EducationalQualification::where('status', 'Active')->take(4)->get();
        $WhichHospitals = WhichHospital::where('status', 'Active')->with(['hospitalSchedule'])->take(3)->get();
        $AwardsRecords = AwardsRecord::where('status', 'Active')->take(3)->get();
        return view('frontend.pages.home.index',[
            'doctorPhotos' => $doctorPhotos,
            'DoctorMyselfs' => $DoctorMyselfs,
            'EducationalQualifications' => $EducationalQualifications,
            'WhichHospitals' => $WhichHospitals,
            'AwardsRecords' => $AwardsRecords
        ]);
    }
    /**
     * Store a new Make an appointment information
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'date' => 'required',
            'hospital'=> 'required',
            'phone' => 'required',
            'description' => 'required'
        ]);

        MakeAppointment::create([
            'name' => $request->name,
            'email' => $request->email,
            'date' => $request->date,
            'hospital' => $request->hospital,
            'phone'=>$request->phone,
            'description'=>$request->description,
            'status' => '1'
        ]);
        return back()->with('MakeAppointment_create_success', 'Make Appointment Submit Successfully');
    }
// show Appointment single page
    public function Appointment(){
        $doctorPhotos = doctorPhoto::where('status', 'Active')->first();
       return view('frontend.pages.appointment.index',[
            'doctorPhotos' => $doctorPhotos
       ]);
    }
    //show Which people single page
    public function WhichHospital()
    {
        $WhichHospitals = WhichHospital::where('status', 'Active')->with(['hospitalSchedule'])->get();
        return view('frontend.pages.WhichHospitals.index', [
            'WhichHospitals' => $WhichHospitals
        ]);
    }
    //show Educational Qualification single page
    public function EducationalQualification()
    {
        $EducationalQualifications = EducationalQualification::where('status', 'Active')->get();
        return view('frontend.pages.doctor-quaification.index', [
            'EducationalQualifications' => $EducationalQualifications
        ]);
    }
}
