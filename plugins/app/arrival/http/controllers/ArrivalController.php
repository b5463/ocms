<?php

namespace App\Arrival\Http\Controllers;

use App\Arrival\Models\Arrival;
use Backend\Classes\Controller;
use App\Arrival\Http\Resources\ArrivalResource;
use Event;
use Illuminate\Http\Request; // Make sure to include the necessary request class

class ArrivalController extends Controller
{
    /**
     * Retrieve a collection of all arrivals.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $arrivals = ArrivalResource::collection(Arrival::all());
            return response()->json($arrivals);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while fetching arrivals.', 500);
        }
    }

    /**
     * Store a new arrival record.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $arrival = new Arrival();
            $arrival->user_id = auth()->user()->id;
            $arrival->name = auth()->user()->name;
            $arrival->arrival = now();
            $arrival->save();
            
            return response()->json(new ArrivalResource($arrival));
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while storing the arrival: ' . $e, 500);
        }
    }

    /**
     * Retrieve arrivals for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsersArrivals()
    {
        try {
            $usersArrivals = Arrival::where('user_id', auth()->user()->id)->get();
            Event::fire('App.Arrival.userArrivalsRequested', [$usersArrivals]);
            return response()->json(ArrivalResource::collection($usersArrivals));
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while fetching user arrivals: ' . $e, 500);
        }
    }

    /**
     * Helper method for returning error responses.
     *
     * @param mixed $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message, $statusCode)
    {
        return response()->json(['error' => $message], $statusCode);
    }
}