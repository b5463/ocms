<?php

namespace Teamgrid\Project\Http\Controllers;

use Teamgrid\Project\Models\Project;
use Backend\Classes\Controller;
use Teamgrid\Project\Http\Resources\ProjectResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ProjectController extends Controller
{
    /**
     * Get a collection of all projects.
     *
     * @return ProjectResource[]
     */
    public function index()
    {
        $projects = Project::all();
        return ProjectResource::collection($projects);
    }

    /**
     * Get the details of a specific project.
     *
     * @param string $key
     * @return ProjectResource|Response
     */
    public function show($key)
    {
        try {
            $project = Project::findOrFail($key);
            
            return new ProjectResource($project);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Project not found'], 404);
        }
    }

    /**
     * Create a new project.
     *
     * @param Request $request
     * @return ProjectResource
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $project = new Project();

        // Fill the project properties from the request
        $this->fillProjectFromRequest($project, $user, $request);

        // Save the project
        $project->save();

        return new ProjectResource($project);
    }

    /**
     * Update an existing project.
     *
     * @param Request $request
     * @param string $key
     * @return ProjectResource|Response
     */
    public function update(Request $request, $key)
    {
        try {
            $user = Auth::user();
            $project = Project::findOrFail($key);

            // Fill the project properties from the request
            $this->fillProjectFromRequest($project, $user, $request);

            // Save the updated project
            $project->save();

            return new ProjectResource($project);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Project not found'], 404);
        }
    }

    /**
     * Mark a project as done.
     *
     * @param string $key
     * @return ProjectResource|Response
     */
    public function markAsDone($key)
    {
        try {
            $project = Project::findOrFail($key);
            $project->is_done = true;
            $project->save();

            return new ProjectResource($project);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Project not found'], 404);
        }
    }

    /**
     * Fill project properties from the request.
     *
     * @param Project $project
     * @param object $user
     * @param Request $request
     * @return void
     */
    private function fillProjectFromRequest(Project $project, $user, Request $request)
    {
      $project->name = $request->input("name");
      $project->description = $request->input("description");
      $project->customer_id = $user->id;
      $project->project_manager_id = $user->id;
      $project->due_date = Carbon::create($request->input('due_date'));
      $project->accounting = $request->input("accounting");
      $project->hourly_rate_price = $request->input("hourly_rate_price");
      $project->budget = $request->input("budget");
      $project->is_done = $request->input("is_done");
    }
}