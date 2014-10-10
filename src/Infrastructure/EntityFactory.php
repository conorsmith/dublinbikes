<?php

namespace ConorSmith\Dublinbikes\Infrastructure;

abstract class EntityFactory
{
    abstract public function buildEntity(array $data);

    public function buildCollection(array $data)
    {
        return array_map([$this, 'buildEntity'], $data);
    }
}