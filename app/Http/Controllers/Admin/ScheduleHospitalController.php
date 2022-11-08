<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScheduleHospital;
use App\Models\WhichHospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class scheduleHospitalController extends Controller
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
     * List of schedule Hospital
     */
    public function show($id)
    {
        if (is_null($this->user) || !$this->user->can('scheduleHospitals.all')) {
            abort(403, 'Unauthorized access');
        }
       $scheduleHospitals = ScheduleHospital::where('hospitals_schedule_id', $id)->with(['adminCreatedBy', 'adminEditedBy', 'hospitalSchedule'])->latest()->get();
       $active_whichHospital_name = WhichHospital::findOrFail($id)->latest()->get();
        return view('admin.pages.schedulhospital.index', [
            'scheduleHospitals' => $scheduleHospitals,
            'active_whichHospital_name' => $active_whichHospital_name
        ]);
    }
    /**
     * Store a new schedule Hospitals information
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('scheduleHospitals.create')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'hospitals_schedule_id' => 'required',
            'day' => 'required',
            'time' => 'required',
            'status' => 'required'
        ]);
        ScheduleHospital::create([
            'hospitals_schedule_id' => $request->hospitals_schedule_id,
            'day' => $request->day,
            'time' => $request->time,
            'status' => $request->status,
            'created_by' => Auth::guard('admin')->User()->id
        ]);
        return back()->with('WhichHospital_create_success', 'Schedule Hospital Created Successfully');
    }
    /**
     * Show the from of specifice schedule Hospital information
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('scheduleHospitals.edit')) {
            abort(403, 'Unauthorized access');
        }
        $scheduleHospital = ScheduleHospital::findOrFail($id);
        $active_whichHospital_name = WhichHospital::all();
        return view('admin.pages.schedulhospital.edit', [
            'scheduleHospital' => $scheduleHospital,
            'active_whichHospital_name'=> $active_whichHospital_name
        ]);
    }
    /**
     * Update a specefic schedule Hospital information
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('scheduleHospitals.edit')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'day' => 'required',
            'time' => 'required',
            'status' => 'required'
        ]);
        $ScheduleHospital = ScheduleHospital::where('id', $id)->first();
        $ScheduleHospitalEdit = $ScheduleHospital;
        $ScheduleHospitalEdit->day = $request->day;
        $ScheduleHospitalEdit->time = $request->time;
        $ScheduleHospitalEdit->status = $request->status;
        $ScheduleHospitalEdit->edited_by = Auth::guard('admin')->User()->id;

        $ScheduleHospitalEdit->save();
        return back()->with('ScheduleHospital_update_success', 'ScheduleHospital Updated Successfully');
    }
    /**
     * Delete single schedule Hospitals data
     */
    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('scheduleHospitals.delete')) {
            abort(403, 'Unauthorized access');
        }
        $scheduleHospital = ScheduleHospital::findOrFail($id);
        $scheduleHospital->delete();
        return back()->with('scheduleHospital_delete_success', 'ScheduleHospital Deleted Successfully');
    }



}
