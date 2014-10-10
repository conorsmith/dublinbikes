<?php

namespace ConorSmith\Dublinbikes\Domain;

use ConorSmith\Dublinbikes\Gettable;

class Station
{
    use Gettable;

    private $id;
    private $number;
    private $name;
    private $location;
    private $totalStands;
    private $acceptsCards;

    public function __construct($id, $number, $name, Location $location, $totalStands, $acceptsCards)
    {
        if ( ! is_int($id) || $id < 1) {
            throw new \UnexpectedValueException("The given ID must be a positive integer.");
        }

        if ( ! is_int($number) || $number < 1) {
            throw new \UnexpectedValueException("The given number must be a positive integer.");
        }

        if ( ! $name) {
            throw new \UnexpectedValueException("The given name must not be empty.");
        }

        if ( ! is_int($totalStands) || $totalStands < 0) {
            throw new \UnexpectedValueException("The given total amount of stands must be a positive integer or zero.");
        }

        if ($acceptsCards !== true && $acceptsCards !== false) {
            throw new \UnexpectedValueException("The given 'accepts cards' attribute must be a boolean.");
        }

        $this->id = $id;
        $this->number = $number;
        $this->name = $name;
        $this->location = $location;
        $this->totalStands = $totalStands;
        $this->acceptsCards = $acceptsCards;
    }
}
