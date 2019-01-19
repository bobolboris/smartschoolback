<?php

namespace App\CabinetComponent\Tools;

use App\MainComponent\Access;
use App\MainComponent\Parents;
use Dompdf\Dompdf;

class ReportGenerator
{
    protected function getDataForParent($parentId, $childId, $startDate, $finishDate)
    {
        $accesses = Access::where('child_id', $childId)
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $finishDate)->get();
        $dates = [];

        foreach ($accesses as $access) {
            $tmp = [
                'number' => @count($dates[$access->date]) + 1,
                'time' => $access->time,
                'direction' => ($access->direction == 2) ? 'Выход' : 'Вход'
            ];
            $dates[$access->date][] = $tmp;
        }
        $parent = Parents::find($parentId);
        return [
            'startDate' => $startDate,
            'finishDate' => $finishDate,
            'dateFormation' => date("Y-m-d"),
            'fullName' => "$parent->surname $parent->name $parent->patronymic",
            'dates' => $dates
        ];
    }

    protected function render($name, $data = [])
    {
        return view($name, $data);
    }

    protected function renderPdf($html)
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        return $dompdf->output();
    }

    public function generateReport($parentId, $childId, $startDate, $finishDate)
    {
        $data = $this->getDataForParent($parentId, $childId, $startDate, $finishDate);
        $html = view('other.reportForParent', $data);
        return $this->renderPdf($html);
        //        $data = $this->getDataForParent(1,1, "2018-12-07", "2018-12-19");
//        return response($this->renderPdf($html))->header('Content-type', 'application/pdf');
    }
}
