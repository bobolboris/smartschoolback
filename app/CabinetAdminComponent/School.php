<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\School as Base;

class School extends Base
{
    protected $with = ['locality'];
}
