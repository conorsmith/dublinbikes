<?php

namespace ConorSmith\Dublinbikes\Domain;

use Carbon\Carbon;
use ConorSmith\Dublinbikes\Domain\Station;
use ConorSmith\Dublinbikes\Gettable;

class RealTimeStatus
{
    use Gettable;

    private $id;
    private $isOpen;
    private $availableStands;
    private $availableBikes;
    private $statusAt;
    private $station;

    public function __construct($id, $isOpen, $availableStands, $availableBikes, Carbon $statusAt, Station $station)
    {
        if ( ! is_int($id) || $id < 1) {
            throw new \UnexpectedValueException("The given ID must be a positive integer.");
        }

        if ($isOpen !== true && $isOpen !== false) {
            throw new \UnexpectedValueException("The given 'is open' attribute must be a boolean.");
        }

        if ( ! is_int($availableStands) || $availableStands < 0) {
            throw new \UnexpectedValueException("The given amount of available stands must be a positive integer or zero.");
        }

        if ( ! is_int($availableBikes) || $availableBikes < 0) {
            throw new \UnexpectedValueException("The given amount of available bikes must be a positive integer or zero.");
        }

        $this->id = $id;
        $this->isOpen = $isOpen;
        $this->availableStands = $availableStands;
        $this->availableBikes = $availableBikes;
        $this->statusAt = $statusAt;
        $this->station = $station;
    }
}
