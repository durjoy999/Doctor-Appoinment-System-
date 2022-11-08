<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MakeAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MakeAnAppointmentController extends Controller
{
    /**
     * Construct method
     */
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
    }
    /**
     * List of all Doctor Make an appointment
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('MakeAppointments.all')) {
            abort(403, 'Unauthorized access');
        }
        $MakeAppointment = MakeAppointment::latest()->get();
        return view('admin.pages.makeanappointment.index', [
            'MakeAppointment' => $MakeAppointment
        ]);
    }
    /**
     * Show the form of creating new Doctor Make an appointment
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('MakeAppointments.create')) {
            abort(403, 'Unauthorized access');
        }
        return view('admin.pages.makeanappointment.create');
    }
    /**
     * Show the form single Doctor Make an appointment
     */
    public function show($id){
        if (is_null($this->user) || !$this->user->can('MakeAppointments.all')) {
            abort(403, 'Unauthorized access');
        }
        $MakeAppointment = MakeAppointment::findOrFail($id);
        return view('admin.pages.makeanappointment.show', [
            'MakeAppointment' => $MakeAppointment
        ]);
    }
    /**
     * Seed massage Doctor Make an appointment
     */
    public function massage(Request $request){
        if (is_null($this->user) || !$this->user->can('MakeAppointments.all')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'message' => 'required',
        ]);

        MakeAppointment::findOrFail($request->id);

        $url = "http://66.45.237.70/api.php";
        $number = "01764085738";

        $text = $request->message;
        $data = array(
            'username' => "01682320494",
            'password' => "SMSFORBFB@2022",
            'number' => "$number",
            'message' => "$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|", $smsresult);
        $sendstatus = $p[0];
        if( $sendstatus !== 1101 ){
            $makeAppointment = MakeAppointment::where('id', $request->id)->first();
            $makeAppointmentEdit = $makeAppointment;
            $makeAppointmentEdit->status = "0";

            $makeAppointmentEdit->save();
            return back()->with('MakeAppointment_Massage_sent_success', 'Slider Deleted Successfully');
        }
    }
    /**
     * Delete single Doctor Make an appointment massage
     */
    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('MakeAppointments.delete')) {
            abort(403, 'Unauthorized access');
        }
        $MakeAppointment = MakeAppointment::findOrFail($id);
        $MakeAppointment->delete();
        return back()->with('MakeAppointment_Massage_sent_success', 'Slider Deleted Successfully');
    }
}
