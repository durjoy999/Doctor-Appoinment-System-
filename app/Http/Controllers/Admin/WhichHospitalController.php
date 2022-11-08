<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\scheduleHospital;
use App\Models\WhichHospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WhichHospitalController extends Controller
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
     * List of all Which Hospital
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('WhichHospitals.all')) {
            abort(403, 'Unauthorized access');
        }
         $WhichHospitals = WhichHospital::with(['adminCreatedBy', 'adminEditedBy', 'hospitalSchedule'])->latest()->get();

        return view('admin.pages.whichhospital.index', [
            'WhichHospitals' => $WhichHospitals
        ]);
    }
    /**
     * Show the form of creating new Which Hospital
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('WhichHospitals.create')) {
            abort(403, 'Unauthorized access');
        }
        return view('admin.pages.whichhospital.create');
    }
    /**
     * Store a new Which Hospital information
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('WhichHospitals.create')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'hospital_Location' =>'required',
            'location' => 'required',
            'seat'=> 'required',
            'fee' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024'
        ]);
        WhichHospital::create([
            'hospital_Location' => $request->hospital_Location,
            'status' => $request->status,
            'location' => $request->location,
            'seat' => $request->seat,
            'image' => $request->image->store('/whichHospital'),
            'fee' => $request->fee,
            'created_by' => Auth::guard('admin')->User()->id,
        ]);
        return back()->with('WhichHospital_create_success', 'Whichhospital Created Successfully');
    }
    /**
     * Show the from of specifice Which Hospital information
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('WhichHospitals.edit')) {
            abort(403, 'Unauthorized access');
        }
        $Whichhospital = WhichHospital::findOrFail($id);
        return view('admin.pages.whichhospital.edit', [
            'Whichhospital' => $Whichhospital
        ]);
    }
    /**
     * Update a specefic Which Hospital information
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('WhichHospitals.edit')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'hospital_Location' => 'required',
            'location' => 'required',
            'seat' => 'required',
            'fee' => 'required',
            'status' => 'required'
        ]);
        $Whichhospital = WhichHospital::where('id', $id)->first();
        $WhichhospitalEdit = $Whichhospital;
        $WhichhospitalEdit->hospital_Location=$request->hospital_Location;
        $WhichhospitalEdit->location = $request->location;
        $WhichhospitalEdit->seat = $request->seat;
        $WhichhospitalEdit->fee = $request->fee;
        $WhichhospitalEdit->status = $request->status;
        $WhichhospitalEdit->edited_by = Auth::guard('admin')->User()->id;

        if ($request->hasFile('image')) {
            Storage::delete('/whichHospital', $Whichhospital->image);
            $WhichhospitalEdit->image = $request->image->store('/whichHospital');
        }

        $WhichhospitalEdit->save();
        return back()->with('Whichhospital_update_success', 'Whichhospital Updated Successfully');
    }
    /**
     * Delete single Which Hospital
     */
    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('WhichHospitals.delete')) {
            abort(403, 'Unauthorized access');
        }
        $Whichhospital = WhichHospital::findOrFail($id);
        scheduleHospital::where('hospitals_schedule_id',$id)->delete();
        Storage::delete($Whichhospital->image);
        $Whichhospital->delete();
        return back()->with('Whichhospital_delete_success', 'Whichhospital Deleted Successfully');
    }
}
