<?php

namespace ConorSmith\Dublinbikes;

use ConorSmith\Dublinbikes\Domain\FetchStationStatusService;
use ConorSmith\Dublinbikes\Infrastructure\LocationFactory;
use ConorSmith\Dublinbikes\Infrastructure\RealTimeStatusFactory;
use ConorSmith\Dublinbikes\Infrastructure\RealTimeStatusInMemoryRepository;
use ConorSmith\Dublinbikes\Infrastructure\StationFactory;
use ConorSmith\Dublinbikes\Infrastructure\StationInMemoryRepository;
use ConorSmith\Dublinbikes\Infrastructure\StationsEndpoint;
use GuzzleHttp\Client as Guzzle;

class Dublinbikes
{
    protected $fetchStationStatusService;
    protected $stationRepo;
    protected $statusRepo;

    public function __construct($apiKey)
    {
        $stationFactory = new StationFactory(new LocationFactory);
        $stationsEndpoint = new StationsEndpoint($apiKey, new Guzzle);

        $this->stationRepo = new StationInMemoryRepository($stationsEndpoint, $stationFactory);
        $this->statusRepo = new RealTimeStatusInMemoryRepository($stationsEndpoint, new RealTimeStatusFactory($stationFactory));
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
