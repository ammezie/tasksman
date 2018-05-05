<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index');
    }

    public function fetchProjects()
    {
        $projects = Project::where('is_completed', false)
                            ->orderBy('created_at', 'desc')
                            ->withCount(['tasks' => function ($query) {
                                $query->where('is_completed', false);
                            }])
                            ->get();

        return $projects->toJson();
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $project = Project::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        return response()->json(['status' => 'Project created!']);
    }

    public function show($id)
    {
        $project = Project::with(['tasks' => function ($query) {
            $query->where('is_completed', false);
        }])->find($id);

        return view('projects.show', compact('project'));
    }

    public function markAsCompleted(Project $project)
    {
        $project->is_completed = true;
        $project->update();

        return back()->with('status', 'Project Approved!');
    }
}
