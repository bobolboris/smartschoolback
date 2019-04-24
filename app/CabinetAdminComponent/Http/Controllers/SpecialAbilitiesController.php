<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Jobs\LoadChildrenJob;
use App\CabinetAdminComponent\Jobs\RecreateDatabaseJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class SpecialAbilitiesController extends BaseController
{
    public function indexAction()
    {
        return view('cabinet_admin.index.special_abilities');
    }

    public function recreateAction()
    {
        $this->dispatch(new RecreateDatabaseJob());
        return redirect(route('admin.db.index'));
    }

    public function loadAction(Request $request)
    {
        $this->validate($request, [
            'start' => ['required', 'regex:/^[A-Z]+[1-9][0-9]*$/i'],
            'finish' => ['required', 'regex:/^[A-Z]+[1-9][0-9]*$/i'],
            'file' => ['required', 'file', 'mimes:ods,xls,xlsx'],
        ]);

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $name = str_replace('/', '1', Hash::make(strval(Carbon::now())));
        $fileName = $name . '.' . $extension;

        $path = $file->move('/tmp', $fileName)->getRealPath();

        $data = [
            'path' => $path,
            'extension' => $extension,
            'start' => $request->get('start'),
            'finish' => $request->get('finish'),
        ];

        $id = $this->dispatch(new LoadChildrenJob($data));

        return redirect(route('admin.db.load_children', ['id' => $id]));
    }

    public function loadChildrenAction(Request $request)
    {
        return view('cabinet_admin.index.load_children', ['jobId' => $request->get('id')]);
    }

    public function getLastEvent(Request $request)
    {
        $id = $request->get('job_id');

        $json = null;

        for ($i = 0; $i < 3; $i++) {
            $json = Redis::rpop('LoadExcel' . $id);

            if ($json != null) {
                break;
            }
            sleep(5);
        }

        if ($json == null) {
            $json = json_encode(['ok' => true]);
        }

        return response()->json([])->setContent($json);
    }
}
