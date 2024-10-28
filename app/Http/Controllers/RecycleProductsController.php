<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Staff;
use Illuminate\Http\Request;

class RecycleProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('staff')->onlyTrashed()->orderBy('id','ASC')->get();
        return view('projects.recycle',compact('projects'));
    }

    public function restore($id){
        $project = Project::withTrashed()->find($id);
        $project->restore();
        return redirect()->back();
    }

    public function restoreAll(Request $request)
    {
        $projectIds = $request->input('project_ids', []); // Get selected project IDs

        if (count($projectIds) > 0) {
            Project::withTrashed()->whereIn('id', $projectIds)->restore();
            return redirect()->route('projects.index')->with('success', 'Selected projects restored successfully.');
        }

        return redirect()->route('projects.index')->with('error', 'No projects selected for restoration.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Project::withTrashed()->find($id);
        if(!empty($delete->file_path)){
            unlink('project_files/'.$delete->file_path);
        }
        $delete->forceDelete();
        return redirect()->back();
    }
}
