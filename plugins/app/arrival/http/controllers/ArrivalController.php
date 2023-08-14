<?php
namespace App\Arrival\Http\Controllers;

use App\Arrival\Models\Arrival;
use Backend\Classes\Controller;
use App\Arrival\Http\Resources\ArrivalResource;
use Illuminate\Support\Facades\Event; // Make sure to import Event class
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return ArrivalResource
     */
    public function store(Request $request)
    {
        try {
            $arrival = new Arrival();
            $arrival->name = $request->input('name');
            $arrival->arrival = $request->input('arrival');
            $arrival->save();

            return new ArrivalResource($arrival);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the arrival: ' . $e->getMessage()], 500);
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
            $allArrivals = Arrival::all();
            Event::dispatch('App.Arrival.userArrivalsRequested', [$allArrivals]);
    
            return ArrivalResource::collection($allArrivals);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching arrivals.'], 500);
        }
    }  
}