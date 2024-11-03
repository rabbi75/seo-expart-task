<?php

namespace App\Http\Controllers;

use App\Jobs\SendOtpJob;
use App\Jobs\SendProjectCreateJob;
use App\Mail\ProjectCreated;
use App\Models\Project;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('staff')->orderBy('id','ASC')->get();
        return view('welcome',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staffs = Staff::orderBy('id','ASC')->get();
        return view('projects.create', compact('staffs'));
    }

    public function fileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx', // adjust max size as needed
        ]);
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads', 'public'); // Store in the 'public/uploads' directory
    
            return response()->json(['file_path' => $path]);
        }
    
        return response()->json(['error' => 'File upload failed'], 400);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'staff_id' => 'required|exists:staff,id',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'status' => 'required|in:active,inactive,hold',
        ]);

        // Handle file upload if there's a file
        $document_name = null;
        if ($request->hasFile('file')) {
            $document = $request->file('file');
            $document_name = rand() . '.' . $document->getClientOriginalExtension();
            $document->move(public_path('/project_files'), $document_name);
        }

        // Create the project
        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'staff_id' => $request->staff_id,
            'file_path' => $document_name,
            'status' => $request->status,
        ]);

        // Send email to admin after project creation
        for($i=0; $i<5; $i++){
            dispatch(new SendProjectCreateJob($project));
        }
        // dispatch(new SendProjectCreateJob($project));

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Project::find($id);
        $delete->delete();
        return redirect()->route('projects.index');
    }

    public function sendOTP(){
        dispatch(new SendOtpJob())->onQueue('high');
        return redirect()->back();
    }
}
