<?php

namespace App\CabinetParentsComponent\Http\Controllers\Children;

use App\CabinetParentsComponent\Tools\ReportGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReportController extends BaseChildrenController
{
    public function reportParentAction(Request $request)
    {
        $result = $this->validateReportParent($request->all());
        if (!$result['ok']) {
            return response()->json($result);
        }
        $rp = new ReportGenerator();

        $user = JWTAuth::parseToken()->authenticate();
        $parentId = $user->parent->id;

        $childId = $request->get('child_id');
        $startDate = $request->get('startDate');
        $finishDate = $request->get('finishDate');

        $reportAndTitle = $rp->generateReport($parentId, $childId, $startDate, $finishDate);
        $reportAndTitle['report'] = base64_encode($reportAndTitle['report']);
        $result['data'] = $reportAndTitle;

        return response()->json($result);
    }

    protected function validateReportParent(array $request)
    {
        $validator = Validator::make($request, [
            'child_id' => 'required|exists:children,id',
            'startDate' => 'required',
            'finishDate' => 'required'
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }
}
