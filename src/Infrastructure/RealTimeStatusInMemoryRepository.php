<?php

namespace ConorSmith\Dublinbikes\Infrastructure;

use ConorSmith\Dublinbikes\Domain\RealTimeStatusRepository;
use ConorSmith\Dublinbikes\Domain\Station;

class RealTimeStatusInMemoryRepository implements RealTimeStatusRepository
{
    private $statuses;

    public function __construct()
    {
        $this->statuses = [];
    }

    public function getLatest()
    {
        $latestStatuses = [];
        $latestStatusAtTimestamps = [];

        foreach ($this->statuses as $status) {
            if ( ! array_key_exists($status->id, $latestStatuses) || $status->statusAt > $latestStatusAtTimestamps[$status->id]) {
                $latestStatuses[$status->id] = $status;
                $latestStatusAtTimestamps[$status->id] = $status->statusAt;
            }
        }

        return $latestStatuses;
    }

    public function find($id)
    {
        return $this->statuses[$id];
    }

    public function findLatestWithStation(Station $station)
    {
        $latestStatus = null
        $latestStatusAtTimestamp = null;

        foreach ($this->statuses as $status) {
            if ($status->station->equals($station) && $status->statusAt > $latestStatusAtTimestamp) {
                $latestStatus = $status;
                $latestStatusAtTimestamp = $status->statusAt;
            }
        }

        return $latestStatus;
    }
}