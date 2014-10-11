<?php

namespace ConorSmith\Dublinbikes\Test\Domain;

use ConorSmith\Dublinbikes\Domain\RealTimeStatus;

use Carbon\Carbon;
use ConorSmith\Dublinbikes\Domain\Location;
use ConorSmith\Dublinbikes\Domain\Station;

class RealTimeStatusTest extends \PHPUnit_Framework_TestCase
{
    private $status;

    public function setUp()
    {
        $this->id = 235;
        $this->isOpen = true;
        $this->availableStands = 34;
        $this->availableBikes = 6;
        $this->statusAt = Carbon::parse('2014-08-04 14:03:12');
        $this->station = new Station(8123, 120, 'Bike Station Zero', new Location(48.862993, 2.344294), 40, true);

        $this->status = new RealTimeStatus($this->id, $this->isOpen, $this->availableStands, $this->availableBikes, $this->statusAt, $this->station);
    }

    /**
     * @test
     */
    public function itIsInitializable()
    {
        new RealTimeStatus($this->id, $this->isOpen, $this->availableStands, $this->availableBikes, $this->statusAt, $this->station);
    }

    /**
     * @test
     */
    public function itHasAnId()
    {
        $id = $this->status->id;
    }

    /**
     * @test
     */
    public function itHasAnIsOpenAttribute()
    {
        $isOpen = $this->status->isOpen;
    }

    /**
     * @test
     */
    public function itHasANumberOfAvailableStands()
    {
        $availableStands = $this->status->availableStands;
    }

    /**
     * @test
     */
    public function itHasANumberOfAvailableBikes()
    {
        $availableBikes = $this->status->availableBikes;
    }

    /**
     * @test
     */
    public function itHasAStatusAtTimestamp()
    {
        $statusAt = $this->status->statusAt;
    }

    /**
     * @test
     */
    public function itHasAStation()
    {
        $station = $this->status->station;
    }

    /**
     * @test
     */
    public function itCanBeCreatedWithItsAttributes()
    {
        $id = 235;
        $isOpen = true;
        $availableStands = 34;
        $availableBikes = 6;
        $statusAt = Carbon::parse('2014-08-04 14:03:12');
        $station = new Station(8123, 120, 'Bike Station Zero', new Location(48.862993, 2.344294), 40, true);

        $status = new RealTimeStatus($id, $isOpen, $availableStands, $availableBikes, $statusAt, $station);

        $this->assertEquals(
            $id
            , $status->id
            , "The RealTimeStatus could not be created with the given ID."
        );
        $this->assertEquals(
            $isOpen
            , $status->isOpen
            , "The RealTimeStatus could not be created with the given value for the 'is open' attribute."
        );
        $this->assertEquals(
            $availableStands
            , $status->availableStands
            , "The RealTimeStatus could not be created with the given number of available stands."
        );
        $this->assertEquals(
            $availableBikes
            , $status->availableBikes
            , "The RealTimeStatus could not be created with the given number of available bikes."
        );
        $this->assertEquals(
            $statusAt
            , $status->statusAt
            , "The RealTimeStatus could not be created with the given 'status at' timestamp."
        );
        $this->assertEquals(
            $station
            , $status->station
            , "The RealTimeStatus could not be created with the given station."
        );
    }

    /**
     * @test
     * @dataProvider nonPositiveIntegerProvider
     */
    public function itCannotBeCreatedWithANonPositiveIntegerId($invalidId)
    {
        $this->setExpectedException('UnexpectedValueException');

        new RealTimeStatus($invalidId, $this->isOpen, $this->availableStands, $this->availableBikes, $this->statusAt, $this->station);
    }

    /**
     * @test
     * @dataProvider nonBooleanProvider
     */
    public function itCannotBeCreatedWithANonBooleanValueForItsIsOpenAttribute($invalidIsOpen)
    {
        $this->setExpectedException('UnexpectedValueException');

        new RealTimeStatus($this->id, $invalidIsOpen, $this->availableStands, $this->availableBikes, $this->statusAt, $this->station);
    }

    /**
     * @test
     * @dataProvider nonNaturalNumberProvider
     */
    public function itCannotBeCreatedWithANonNaturalNumberAmountOfAvailableStands($invalidAvailableStands)
    {
        $this->setExpectedException('UnexpectedValueException');

        new RealTimeStatus($this->id, $this->isOpen, $invalidAvailableStands, $this->availableBikes, $this->statusAt, $this->station);
    }

    /**
     * @test
     * @dataProvider nonNaturalNumberProvider
     */
    public function itCannotBeCreatedWithANonNaturalNumberAmountOfAvailableBikes($invalidAvailableBikes)
    {
        $this->setExpectedException('UnexpectedValueException');

        new RealTimeStatus($this->id, $this->isOpen, $this->availableStands, $invalidAvailableBikes, $this->statusAt, $this->station);
    }

    public function nonNaturalNumberProvider()
    {
        return [
            [[]],
            ['not a number'],
            [''],
            [true],
            [false],
            [null],
            [2.14159],
            [-34],
        ];
    }

    public function nonPositiveIntegerProvider()
    {
        return array_merge($this->nonNaturalNumberProvider(), [
            [0],
        ]);
    }

    public function nonBooleanProvider()
    {
        return [
            [[]],
            ['not a number'],
            [''],
            [null],
            [2.14159],
            [-34],
            [0],
            [39]
        ];
    }
}
