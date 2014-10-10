<?php

namespace ConorSmith\Dublinbikes\Test;

use ConorSmith\Dublinbikes\Domain\Station;

use ConorSmith\Dublinbikes\Domain\Location;

class StationTest extends \PHPUnit_Framework_TestCase
{
    private $station;

    public function setUp()
    {
        $this->id = 8123;
        $this->number = 120;
        $this->name = 'Bike Station Zero';
        $this->location = new Location(48.862993, 2.344294);
        $this->totalStands = 40;
        $this->acceptsCards = true;
        
        $this->station = new Station($this->id, $this->number, $this->name, $this->location, $this->totalStands, $this->acceptsCards);
    }

    /**
     * @test
     */
    public function itIsInitializable()
    {
        new Station($this->id, $this->number, $this->name, $this->location, $this->totalStands, $this->acceptsCards);
    }

    /**
     * @test
     */
    public function itHasAnId()
    {
        $id = $this->station->id;
    }

    /**
     * @test
     */
    public function itHasANumber()
    {
        $number = $this->station->number;
    }

    /**
     * @test
     */
    public function itHasAName()
    {
        $name = $this->station->name;
    }

    /**
     * @test
     */
    public function itHasALocation()
    {
        $location = $this->station->location;
    }

    /**
     * @test
     */
    public function itHasATotalNumberOfStands()
    {
        $totalStands = $this->station->totalStands;
    }

    /**
     * @test
     */
    public function itHasAnAcceptsCardsAttribute()
    {
        $acceptsCards = $this->station->acceptsCards;
    }

    /**
     * @test
     */
    public function itCanBeCreatedWithItsAttributes()
    {
        $id = 8123;
        $number = 120;
        $name = 'Bike Station Zero';
        $location = new Location(48.862993, 2.344294);
        $totalStands = 40;
        $acceptsCards = true;

        $station = new Station($id, $number, $name, $location, $totalStands, $acceptsCards);

        $this->assertEquals(
            $id
            , $station->id
            , "The Station could not be created with the given ID."
        );
        $this->assertEquals(
            $number
            , $station->number
            , "The Station could not be created with the given number."
        );
        $this->assertEquals(
            $name
            , $station->name
            , "The Station could not be created with the given name."
        );
        $this->assertEquals(
            $location
            , $station->location
            , "The Station could not be created with the given location."
        );
        $this->assertEquals(
            $totalStands
            , $station->totalStands
            , "The Station could not be created with the given total number of stands."
        );
        $this->assertEquals(
            $acceptsCards
            , $station->acceptsCards
            , "The Station could not be created with the given 'accepts cards' attribute."
        );
    }

    /**
     * @test
     * @dataProvider nonPositiveIntegerProvider
     */
    public function itCannotBeCreatedWithANonPositiveIntegerId($invalidId)
    {
        $this->setExpectedException('UnexpectedValueException');

        new Station($invalidId, $this->number, $this->name, $this->location, $this->totalStands, $this->acceptsCards);
    }

    /**
     * @test
     * @dataProvider nonPositiveIntegerProvider
     */
    public function itCannotBeCreatedWithANonPositiveIntegerNumber($invalidNumber)
    {
        $this->setExpectedException('UnexpectedValueException');

        new Station($this->id, $invalidNumber, $this->name, $this->location, $this->totalStands, $this->acceptsCards);
    }

    /**
     * @test
     */
    public function itCannotBeCreatedWithoutAName()
    {
        $this->setExpectedException('UnexpectedValueException');

        new Station($this->id, $this->number, '', $this->location, $this->totalStands, $this->acceptsCards);
    }

    /**
     * @test
     * @dataProvider nonNaturalNumberProvider
     */
    public function itCannotBeCreatedWithANonNaturalNumberTotalAmountOfStands($invalidTotalStands)
    {
        $this->setExpectedException('UnexpectedValueException');

        new Station($this->id, $this->number, $this->name, $this->location, $invalidTotalStands, $this->acceptsCards);
    }

    /**
     * @test
     * @dataProvider nonBooleanProvider
     */
    public function itCannotBeCreatedWithANonBooleanValueForItsAcceptsCardsAttribute($invalidAcceptsCards)
    {
        $this->setExpectedException('UnexpectedValueException');

        new Station($this->id, $this->number, $this->name, $this->location, $this->totalStands, $invalidAcceptsCards);
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
