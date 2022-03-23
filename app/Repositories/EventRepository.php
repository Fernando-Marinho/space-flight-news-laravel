<?php

namespace App\Repositories;

use App\Models\Event;

class EventRepository
{
    public function saveEvent($data){
        Event::create($data);
    }
}
