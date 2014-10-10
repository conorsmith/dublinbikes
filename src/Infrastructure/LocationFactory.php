<?php

namespace ConorSmith\Dublinbikes\Infrastructure;

use ConorSmith\Dublinbikes\Domain\Location;

class LocationFactory
{
    private $attributes = [
        'lat',
        'lng',
    ];

    public function build(array $data)
    {
        foreach ($this->attributes as $attr) {
            if ( ! array_key_exists($attr, $data)) {
                throw new \InvalidArgumentException("The data given is missing the attribute '$attr'.");
            }
        }

        return new Location($data['lat'], $data['lng']);
    }
}
