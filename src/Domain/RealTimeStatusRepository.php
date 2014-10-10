<?php

namespace ConorSmith\Dublinbikes\Domain;

class RealTimeStatusRepository
{
    public function getLatest();
    public function find($id);
    public function findLatestWithStation(Station $station);
}
