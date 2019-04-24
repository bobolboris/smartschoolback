<?php

namespace App\CabinetAdminComponent\Jobs;

use App\MainComponent\Jobs\Job;
use Illuminate\Support\Facades\DB;

class RecreateDatabaseJob extends Job
{
    public function handle()
    {
        $sql = file_get_contents(public_path('drop.sql')) . file_get_contents(public_path('smart_school_back.sql'));
        DB::unprepared(DB::raw($sql));
    }
}
