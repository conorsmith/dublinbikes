<?php

namespace ConorSmith\Dublinbikes;

trait Gettable
{
    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->$key;
        }

        throw new \RuntimeException("The property '$key' does not exist on this object.");
    }
}
