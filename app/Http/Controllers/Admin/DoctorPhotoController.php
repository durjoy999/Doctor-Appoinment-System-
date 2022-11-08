<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorPhoto;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class doctorPhotoController extends Controller
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
 * List of Single Doctor Photo
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('doctorPhotos.all')) {
            abort(403, 'Unauthorized access');
        }
        $doctorPhotos = DoctorPhoto::with(['adminCreatedBy', 'adminEditedBy'])->latest()->get();
        return view('admin.pages.doctorphoto.index', [
            'doctorPhotos' => $doctorPhotos
        ]);
    }
    /**
     * Show the form of creating new Doctor Photo
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('doctorPhotos.create')) {
            abort(403, 'Unauthorized access');
        }
        return view('admin.pages.doctorphoto.create');
    }
    /**
     * Store a new Doctor Photo information
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('doctorPhotos.create')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'status' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024'
        ]);

    if (DoctorPhoto::count() == '1'){
         return back()->with('error_create_success', 'Already your save 1 Photo');
    }
    else{
        DoctorPhoto::create([
            'status' => $request->status,
            'image' => $request->image->store('doctorPhoto'),
            'created_by' => Auth::guard('admin')->User()->id
        ]);
        return back()->with('doctor_create_success', 'Doctor Created Successfully');
    }
    }
    /**
     * Show the from of specifice Doctor Photo information
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('doctorPhotos.edit')) {
            abort(403, 'Unauthorized access');
        }
        $doctorPhoto = DoctorPhoto::findOrFail($id);
        return view('admin.pages.doctorphoto.edit', [
            'doctorPhoto' => $doctorPhoto
        ]);
    }
    /**
     * Update a specefic Doctor Photo information
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('doctorPhotos.edit')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'status' => 'required'
        ]);
        $DoctorPhoto = DoctorPhoto::where('id', $id)->first();
        $DoctorPhotoEdit = $DoctorPhoto;
        $DoctorPhotoEdit->status = $request->status;
        $DoctorPhotoEdit->edited_by = Auth::guard('admin')->User()->id;

        if ($request->hasFile('image')) {
            Storage::delete('/doctorPhoto', $DoctorPhoto->image);
            $DoctorPhotoEdit->image = $request->image->store('/doctorPhoto');
        }
        $DoctorPhotoEdit->save();
        return back()->with('DoctorPhoto_update_success', 'Slider Updated Successfully');
    }
    /**
     * Delete single Doctor Photo
     */
    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('doctorPhotos.delete')) {
            abort(403, 'Unauthorized access');
        }
        $DoctorPhoto = $this->getSpecificItem($id);
        Storage::delete($DoctorPhoto->image);
        $DoctorPhoto->delete();
        return back()->with('DoctorPhoto_delete_success', 'Slider Deleted Successfully');
    }

    /**
     * return specific item
     */
    public function getSpecificItem($id){
        return doctorPhoto::findOrFail($id);
    }

}
