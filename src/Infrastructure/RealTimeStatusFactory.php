<?php

namespace ConorSmith\Dublinbikes\Infrastructure;

use Carbon\Carbon;
use ConorSmith\Dublinbikes\Domain\RealTimeStatus;
use ConorSmith\Dublinbikes\Infrastructure\StationFactory;

class RealTimeStatusFactory extends EntityFactory
{
    private $attributes = [
        'status',
        'available_bike_stands',
        'available_bikes',
        'last_update',
    ];

    private $stationFactory;

    public function __construct(StationFactory $stationFactory)
    {
        $this->stationFactory = $stationFactory;
    }

    public function buildEntity(array $data)
    {
        foreach ($this->attributes as $attr) {
            if ( ! array_key_exists($attr, $data)) {
                throw new \InvalidArgumentException("The data given is missing the attribute '$attr'.");
            }
        }

        $id = mt_rand();
        $isOpen = $data['status'] === 'OPEN';
        $statusAt = Carbon::createFromTimestamp($data['last_update'] / 1000);
        $station = $this->stationFactory->buildEntity($data);

        return new RealTimeStatus($id, $isOpen, $data['available_bike_stands'], $data['available_bikes'], $statusAt, $station);
    }
}
