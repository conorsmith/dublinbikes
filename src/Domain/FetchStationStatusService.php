<?php

namespace ConorSmith\Dublinbikes\Domain;

class FetchStationStatusService
{
    private $stationRepo;
    private $statusRepo;

    public function __construct(StationRepository $stationRepo, RealTimeStatusRepository $statusRepo)
    {
        $this->stationRepo = $stationRepo;
        $this->statusRepo = $statusRepo;
    }

    public function fetch($stationNumber)
    {
        $station = $this->stationRepo->findWithNumber($stationNumber);
        return $this->statusRepo->findLatestWithStation($station);
    }
}
