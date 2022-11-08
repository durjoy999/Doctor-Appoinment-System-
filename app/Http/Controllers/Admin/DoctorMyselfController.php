<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorMyself;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\all;

class DoctorMyselfController extends Controller
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
     * List of Doctor Introducing to myself
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('doctormyselfs.all')) {
            abort(403, 'Unauthorized access');
        }
        $doctormyselfs = DoctorMyself::with(['adminCreatedBy', 'adminEditedBy'])->latest()->get();
        return view('admin.pages.doctormyself.index', [
            'doctormyselfs' => $doctormyselfs
        ]);
    }
    /**
     * Show the form of creating new Doctor Introducing to myself
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('doctormyselfs.create')) {
            abort(403, 'Unauthorized access');
        }
        return view('admin.pages.doctormyself.create');
    }
    /**
     * Store a new Doctor Introducing to myself information
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('doctormyselfs.create')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'Sdescription'=> 'required',
            'position' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024'

        ]);
        if (DoctorMyself::count() == '0') {
            DoctorMyself::create([
                'status' => $request->status,
                'name' => $request->name,
                'description' => $request->description,
                'Sdescription' => $request->Sdescription,
                'position' => $request->position,
                'image' => $request->image->store('/doctormyself'),
                'created_by' => Auth::guard('admin')->User()->id,
            ]);
            return back()->with('doctormyself_create_success', 'Doctor Created Successfully');
        }
        else
        {
            return back()->with('error_create_success', 'Your Already Record Doctor Myself ');
        }
    }
    /**
     * Show the from of specifice Doctor Introducing to myself information
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('doctormyselfs.edit')) {
            abort(403, 'Unauthorized access');
        }
        $doctormyself = DoctorMyself::findOrFail($id);
        return view('admin.pages.doctormyself.edit', [
            'doctormyself' => $doctormyself
        ]);
    }
    /**
     * Update a specefic Doctor Introducing to myself information
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('doctormyselfs.edit')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'description' => 'required',
            'Sdescription' => 'required',
            'position' => 'required'

        ]);
        $doctormyself = DoctorMyself::where('id', $id)->first();
        $DoctormyselfEdit = $doctormyself;
        $DoctormyselfEdit->name = $request->name;
        $DoctormyselfEdit->position = $request->position;
        $DoctormyselfEdit->status = $request->status;
        $DoctormyselfEdit->description = $request->description;
        $DoctormyselfEdit->Sdescription = $request->Sdescription;
        $DoctormyselfEdit->edited_by = Auth::guard('admin')->User()->id;

        if ($request->hasFile('image')) {
            Storage::delete('/doctormyself', $doctormyself->image);
            $DoctormyselfEdit->image = $request->image->store('/doctormyself');
        }
        $DoctormyselfEdit->save();
        return back()->with('Doctormyself_update_success', 'Slider Updated Successfully');
    }
    /**
     * Delete single Doctor Introducing to myself
     */
    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('doctormyselfs.delete')) {
            abort(403, 'Unauthorized access');
        }
        $doctormyself = DoctorMyself::findOrFail($id);
        Storage::delete($doctormyself->image);
        $doctormyself->delete();
        return back()->with('Doctormyself_delete_success', 'Slider Deleted Successfully');
    }

}
