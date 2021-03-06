<?php

namespace ConorSmith\Dublinbikes\Infrastructure;

use ConorSmith\Dublinbikes\Domain\StationRepository;

class StationInMemoryRepository implements StationRepository
{
    private $stations;

    public function __construct(StationsEndpoint $endpoint, StationFactory $factory)
    {
        $this->stations = $factory->buildCollection($endpoint->get());
    }

    public function all()
    {
        return $this->stations;
    }

    public function find($id)
    {
        return $this->stations[$id];
    }

    public function findWithNumber($number)
    {
        foreach ($this->stations as $station) {
            if ($station->number == $number) {
                return $station;
            }
        }
    }
}
