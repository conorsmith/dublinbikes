<?php

namespace ConorSmith\Dublinbikes\Domain;

use ConorSmith\Dublinbikes\Gettable;

class Location
{
    use Gettable;

    private $latitude;
    private $longitude;

    public function __construct($latitude, $longitude)
    {
        if ( ! is_numeric($latitude)) {
            throw new \UnexpectedValueException("The given latitude must be a number.");
        }
        if ( ! is_numeric($longitude)) {
            throw new \UnexpectedValueException("The given longitude must be a number.");
        }

        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}
