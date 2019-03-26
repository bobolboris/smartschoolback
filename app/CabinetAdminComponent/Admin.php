<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\Admin as Base;

class Admin extends Base
{
    protected $with = ['user'];

}
