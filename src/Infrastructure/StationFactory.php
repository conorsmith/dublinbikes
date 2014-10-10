<?php

namespace ConorSmith\Dublinbikes\Infrastructure;

use ConorSmith\Dublinbikes\Domain\Station;

class StationFactory extends EntityFactory
{
    private $attributes = [
        'number',
        'address',
        'position',
        'banking',
        'bike_stands',
    ];

    private $locationFactory;

    public function __construct(LocationFactory $locationFactory)
    {
        $this->locationFactory = $locationFactory;
    }

    public function buildEntity(array $data)
    {
        foreach ($this->attributes as $attr) {
            if ( ! array_key_exists($attr, $data)) {
                throw new \InvalidArgumentException("The data given is missing the attribute '$attr'.");
            }
        }

        $id = $data['number'];
        $location = $this->locationFactory->build($data['position']);

        return new Station($id, $data['number'], $data['address'], $location, $data['bike_stands'], $data['banking']);
    }
}
