<?php

namespace App;

use App\Model\Event;
use Laravel\Spark\Team as SparkTeam;

class Team extends SparkTeam
{
    public function events()
    {
        return $this->belongsTo(Event::class);
    }
}
