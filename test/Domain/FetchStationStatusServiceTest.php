<?php

namespace ConorSmith\Dublinbikes\Test\Domain;

use Mockery as M;
use ConorSmith\Dublinbikes\Domain\FetchStationStatusService;

use ConorSmith\Dublinbikes\Domain\Location;
use ConorSmith\Dublinbikes\Domain\Station;

class FetchStationStatusServiceTest extends \PHPUnit_Framework_TestCase
{
    private $service;

    public function setUp()
    {
        $this->stationRepoStub = M::mock('ConorSmith\\Dublinbikes\\Domain\\StationRepository');
        $this->statusRepoStub = M::mock('ConorSmith\\Dublinbikes\\Domain\\RealTimeStatusRepository');

        $this->service = new FetchStationStatusService($this->stationRepoStub, $this->statusRepoStub);
    }

    /**
     * @test
     */
    public function itIsInitializable()
    {
        new FetchStationStatusService(
            M::mock('ConorSmith\\Dublinbikes\\Domain\\StationRepository'),
            M::mock('ConorSmith\\Dublinbikes\\Domain\\RealTimeStatusRepository')
        );
    }

    /**
     * @test
     */
    public function itCanFetchTheRealTimeStatusOfAStation()
    {
        $stationNumber = 101;
        $station = new Station(8123, $stationNumber, 'Bike Station Zero', new Location(48.862993, 2.344294), 40, true);

        $this->stationRepoStub->shouldReceive('findWithNumber')
            ->with($stationNumber)
            ->andReturn($station);

        $this->statusRepoStub->shouldReceive('findLatestWithStation')
            ->with($station);

        $this->service->fetch($stationNumber);
    }
}
