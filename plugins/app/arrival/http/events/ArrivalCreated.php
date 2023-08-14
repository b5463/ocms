<?php
namespace App\Arrival\Http\Events;

use App\Arrival\Models\Arrival;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArrivalCreated
{
    use Dispatchable, SerializesModels;


    /**
     * The created arrival instance.
     *
     * @var Arrival
     */
    public $arrival;

    /**
     * Create a new event instance.
     *
     * @param Arrival $arrival
     * @return void
     */
    public function __construct(Arrival $arrival)
    {
        $this->arrival = $arrival;
    }
}