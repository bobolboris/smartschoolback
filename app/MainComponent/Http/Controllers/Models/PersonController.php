<?php

namespace App\MainComponent\Http\Controllers\Models;

use App\MainComponent\Http\Controllers\ModelExtendedController;
use App\MainComponent\Person;

class PersonController extends ModelExtendedController
{
    protected $class = Person::class;
}
