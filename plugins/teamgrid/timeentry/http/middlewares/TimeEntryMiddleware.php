<?php

namespace Teamgrid\Timeentry\Http\Middlewares;

use Teamgrid\Timeentry\Models\TimeEntry;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TimeEntryMiddleware
 * @package Teamgrid\Timeentry\Http\Middlewares
 */
class TimeEntryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = auth()->user();
            $name = $user->name;

            $timeentry = TimeEntry::where('id', $request->route('key'))->firstOrFail();
            if ($name !== $timeentry->user_name) {
                return response("You do not have permission to access this time entry.", 403);
            }

            return $next($request);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response("Time entry not found.", 404);
        } catch (\Exception $e) {
            return response("An error occurred.", 500);
        }
    }
}