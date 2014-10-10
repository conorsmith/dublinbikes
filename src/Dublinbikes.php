<?php

namespace ConorSmith\Dublinbikes;

use ConorSmith\Dublinbikes\Domain\FetchStationStatusService;

class Dublinbikes
{
    protected $fetchStationStatusService;
    protected $stationRepo;
    protected $statusRepo;

    public function __construct($apiKey)
    {
        $this->fetchStationStatusService = new FetchStationStatusService($this->stationRepo, $this->statusRepo);
    }

    public function getStations()
    {
        return $this->stationRepo->all();
    }

    public function getCurrentStatuses()
    {
        return $this->statusRepo->getLatest();
    }

    public function getStationStatus($stationNumber)
    {
        return $this->fetchStationStatusService->fetch($stationNumber);
    }
}
