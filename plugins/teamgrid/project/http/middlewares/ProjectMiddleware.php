<?php

namespace Teamgrid\Project\Http\Middlewares;

use Teamgrid\Project\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $userId = $user->id;
        $projectId = $request->route('key');

        try {
            $project = Project::where('id', $projectId)->firstOrFail();
            
            if ($userId !== $project->project_manager_id) {
                return response("You are not a member of the project", 403);
            }

            return $next($request);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response("Project not found", 404);
        }
    }
}