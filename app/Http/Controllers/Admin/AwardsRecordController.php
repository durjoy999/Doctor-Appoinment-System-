<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AwardsRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AwardsRecordController extends Controller
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
     * List of all Award photo
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('AwardsRecords.all')) {
            abort(403, 'Unauthorized access');
        }
        $AwardsRecords = AwardsRecord::with(['adminCreatedBy', 'adminEditedBy'])->latest()->get();
        return view('admin.pages.awardrecord.index', [
            'AwardsRecords' => $AwardsRecords
        ]);
    }
    /**
     * Show the form of creating new award
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('AwardsRecords.create')) {
            abort(403, 'Unauthorized access');
        }
        return view('admin.pages.awardrecord.create');
    }
    /**
     * Store a new award information
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('AwardsRecords.create')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024'
        ]);
        AwardsRecord::create([
            'status' => $request->status,
            'name' => $request->name,
            'title' => $request->title,
            'image' => $request->image->store('/doctormyself'),
            'created_by' => Auth::guard('admin')->User()->id,
        ]);
        return back()->with('awardRecord_create_success', 'Doctor Record Created Successfully');
    }
    /**
     * Show the from of specifice Award information
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('AwardsRecords.edit')) {
            abort(403, 'Unauthorized access');
        }
        $AwardsRecords = AwardsRecord::findOrFail($id);
        return view('admin.pages.awardrecord.edit', [
            'AwardsRecords' => $AwardsRecords
        ]);
    }
    /**
     * Update a specefic Award information
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('AwardsRecords.edit')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'status' => 'required'
        ]);
        $AwardsRecords = AwardsRecord::where('id', $id)->first();
        $AwardsRecordsEdit = $AwardsRecords;
        $AwardsRecordsEdit->name = $request->name;
        $AwardsRecordsEdit->title = $request->title;
        $AwardsRecordsEdit->status = $request->status;
        $AwardsRecordsEdit->edited_by = Auth::guard('admin')->User()->id;

        if ($request->hasFile('image')) {
        Storage::delete('/AwardsRecord', $AwardsRecords->image);
            $AwardsRecordsEdit->image = $request->image->store('/AwardsRecord');
        }
        $AwardsRecordsEdit->save();
        return back()->with('AwardsRecords_update_success', 'AwardsRecords_update_success');
    }
    /**
     * Delete single Award
     */
    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('AwardsRecords.delete')) {
            abort(403, 'Unauthorized access');
        }
        $AwardsRecord = AwardsRecord::findOrFail($id);
        Storage::delete($AwardsRecord->image);
        $AwardsRecord->delete();
        return back()->with('AwardsRecord_delete_success', 'Slider Deleted Successfully');
    }
}
