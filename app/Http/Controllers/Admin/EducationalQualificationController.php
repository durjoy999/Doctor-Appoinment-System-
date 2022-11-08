<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationalQualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EducationalQualificationController extends Controller
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
     * List of all Doctor Educational Qualifications
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('educationals.all')) {
            abort(403, 'Unauthorized access');
        }
        $EducationalQualifications = EducationalQualification::with(['adminCreatedBy', 'adminEditedBy'])->latest()->get();
        return view('admin.pages.educationalqualification.index', [
            'EducationalQualifications' => $EducationalQualifications
        ]);
    }
    /**
     * Show the form of creating new Doctor Educational Qualifications
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('educationals.create')) {
            abort(403, 'Unauthorized access');
        }
        return view('admin.pages.educationalqualification.create');
    }
    /**
     * Store a new Doctor Educational Qualifications information
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('educationals.create')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'year' => 'required',
            'description' => 'required',
            'univarsity' => 'required',
            'status' => 'required'
        ]);
        EducationalQualification::create([
            'status' => $request->status,
            'year' => $request->year,
            'description' => $request->description,
            'univarsity' => $request->univarsity,
            'created_by' => Auth::guard('admin')->User()->id,
        ]);
        return back()->with('EducationalQualification_create_success', 'Doctor Created Successfully');
    }
    /**
     * Show the from of specifice Doctor Educational Qualifications information
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('educationals.edit')) {
            abort(403, 'Unauthorized access');
        }
        $EducationalQualification = EducationalQualification::findOrFail($id);
        return view('admin.pages.educationalqualification.edit', [
            'EducationalQualification' => $EducationalQualification
        ]);
    }
    /**
     * Update a specefic Doctor Educational Qualifications information
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('educationals.edit')) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'year' => 'required',
            'description' => 'required',
            'univarsity' => 'required',
            'status' => 'required'
        ]);
        $EducationalQualification = EducationalQualification::where('id', $id)->first();
        $EducationalQualificationEdit = $EducationalQualification;
        $EducationalQualificationEdit->year = $request->year;
        $EducationalQualificationEdit->description = $request->description;
        $EducationalQualificationEdit->univarsity = $request->univarsity;
        $EducationalQualificationEdit->status = $request->status;
        $EducationalQualificationEdit->edited_by = Auth::guard('admin')->User()->id;

        $EducationalQualificationEdit->save();
        return back()->with('EducationalQualification_update_success', 'Slider Updated Successfully');
    }
    /**
     * Delete single Doctor Educational Qualifications
     */
    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('educationals.delete')) {
            abort(403, 'Unauthorized access');
        }
        $EducationalQualification = EducationalQualification::findOrFail($id);
        $EducationalQualification->delete();
        return back()->with('EducationalQualification_delete_success', 'Slider Deleted Successfully');
    }
}
