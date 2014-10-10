<?php

namespace ConorSmith\Dublinbikes\Test;

use ConorSmith\Dublinbikes\Domain\Location;

class LocationTest extends \PHPUnit_Framework_TestCase
{
    public $location;

    public function setUp()
    {
        $this->location = new Location(48.862993, 2.344294);
    }

    /**
     * @test
     */
    public function itIsInitializable()
    {
        new Location(48.862993, 2.344294);
    }

    /**
     * @test
     */
    public function itHasALatitude()
    {
        $latitude = $this->location->latitude;
    }

    /**
     * @test
     */
    public function itHasALongitude()
    {
        $longitude = $this->location->longitude;
    }

    /**
     * @test
     */
    public function itCanBeCreatedWithALatitudeAndLongitude()
    {
        $latitude = 48.862993;
        $longitude = 2.344294;

        $location = new Location($latitude, $longitude);

        $this->assertEquals(
            $latitude
            , $location->latitude
            , "The Location could not be created with the given latitude."
        );
        $this->assertEquals(
            $longitude
            , $location->longitude
            , "The Location could not be created with the given longitude."
        );
    }

    /**
     * @test
     */
    public function itCannotBeCreatedWithANonNumericLatitude()
    {
        $this->setExpectedException('UnexpectedValueException');

        new Location('not a number', 2.344294);
    }

    /**
     * @test
     */
    public function itCannotBeCreatedWithANonNumericLongitude()
    {
        $this->setExpectedException('UnexpectedValueException');

        new Location(48.862993, 'not a number');
    }
}
