<?php

namespace ConorSmith\Dublinbikes\Domain;

interface RealTimeStatusRepository
{
    public function getLatest();
    public function find($id);
    public function findLatestWithStation(Station $station);
}
