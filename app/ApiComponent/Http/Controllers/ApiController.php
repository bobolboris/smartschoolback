<?php

namespace App\ApiComponent\Http\Controllers;

use App\MainComponent\Http\Controllers\Controller;
use App\MainComponent\Http\Controllers\Models\SchoolController;

class ApiController extends Controller
{
    public function schools()
    {
        $schoolController = new SchoolController();
        $result = ['ok' => true, 'schools' => $schoolController->getAll()];
        return response()->json($result);
    }
}
