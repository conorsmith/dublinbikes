<?php

namespace ConorSmith\Dublinbikes\Domain;

interface StationRepository
{
    public function all();
    public function find($id);
    public function findWithNumber($number);
}
