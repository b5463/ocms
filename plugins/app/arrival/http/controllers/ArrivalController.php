<?php

namespace App\Arrival\Http\Controllers;

use App\Arrival\Models\Arrival;
use App\Http\Controllers\Controller; // Use the appropriate base controller
use App\Arrival\Http\Resources\ArrivalResource;
use Illuminate\Support\Facades\Event;

class ArrivalController extends Controller
{
    /**
     * Get a collection of all arrivals.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ArrivalResource::collection(Arrival::all());
    }

    /**
     * Store a new arrival record.
     *
     * @return ArrivalResource
     */
    public function store()
    {
        try {
            $arrival = new Arrival();
            $arrival->user_id = auth()->user()->id;
            $arrival->name = auth()->user()->name;
            $arrival->arrival = now();
            $arrival->save();
    
            return new ArrivalResource($arrival);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the arrival.'], 500);
        }
    }    

    /**
     * Get a collection of arrivals for the authenticated user.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUsersArrivals()
    {
        try {
            $usersArrivals = Arrival::where('user_id', auth()->user()->id)->get();
            Event::dispatch('App.Arrival.userArrivalsRequested', [$usersArrivals]);
    
            return ArrivalResource::collection($usersArrivals);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching user arrivals.'], 500);
        }
    }
    
}