<?php

namespace App\Repositories;

use App\Models\Launch;

class LaunchRepository
{
    public function saveLaunch($data){
        Launch::create($data);
    }
}
