<?php

namespace App\CabinetParentsComponent\Tools;

use Alexusmai\Ruslug\RuslugFacade;
use App\CabinetParentsComponent\Access;
use App\CabinetParentsComponent\Child;
use App\CabinetParentsComponent\ParentModel;
use Dompdf\Dompdf;

class ReportGenerator
{
    protected $monthName;

    public function __construct()
    {
        $this->monthName = [
            '01' => 'Январь',
            '02' => 'Февраль',
            '03' => 'Март',
            '04' => 'Апрель',
            '05' => 'Май',
            '06' => 'Июнь',
            '07' => 'Июль',
            '08' => 'Август',
            '09' => 'Сентябрь',
            '10' => 'Октябрь',
            '11' => 'Ноябрь',
            '12' => 'Декабрь'
        ];
    }

    protected function getDataForParent($parentId, $childId, $startDate, $finishDate)
    {
        $accesses = Access::where('child_id', $childId)
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $finishDate)
            ->orderBy('date', 'desc')
            ->get();

        $child = Child::find($childId);
        $parent = ParentModel::find($parentId);

        $dates = [];

        $previousDate = null;

        $day = '01';
        $month = '01';
        $year = '1991';

        foreach ($accesses as $access) {
            if ($previousDate != $access->date) {
                $temp = explode('-', $access->date);

                $day = $temp[2];
                $month = $this->monthName[$temp[1]];
                $year = $temp[0];

                $previousDate = $access->date;
            }

            $tmp = [
                'number' => @count($dates[$access->date]) + 1,
                'time' => substr($access->time, 0, 5),
                'access_point' => $access->accessPoint->name,
                'direction' => ($access->direction == 2) ? 'Выход' : 'Вход'
            ];

            $date = "$day $month $year";

            $dates[$date][] = $tmp;
        }

        $childProfile = $child->profile;
        $parentProfile = $parent->profile;

        $firstSymbolNameChild = substr($childProfile->name, 0, 2);
        $firstSymbolPatronymicChild = substr($childProfile->name, 0, 2);

        $schoolName = $child->class->school->name;
        $title = "report $childProfile->surname $firstSymbolNameChild$firstSymbolPatronymicChild $schoolName";
        $title = str_replace(' ', '_', $title);
        $title = RuslugFacade::make($title);

        return [
            'title' => $title,
            'startDate' => $startDate,
            'finishDate' => $finishDate,
            'dateFormation' => date('Y-m-d'),
            'class' => $child->class->name,
            'school' => $child->class->school->name,
            'address' => $child->class->school->address,
            'fullNameChild' => "$childProfile->surname $childProfile->name $childProfile->patronymic",
            'fullNameParent' => "$parentProfile->surname $parentProfile->name $parentProfile->patronymic",
            'dates' => $dates
        ];
    }

    protected function render($name, $data = [])
    {
        return view($name, $data);
    }

    protected function renderPdf($html)
    {
        $domPdf = new Dompdf();
        $domPdf->loadHtml($html);
        $domPdf->setPaper('A4');
        $domPdf->render();
        return $domPdf->output();
    }

    public function generateReport($parentId, $childId, $startDate, $finishDate)
    {
        $data = $this->getDataForParent($parentId, $childId, $startDate, $finishDate);
        $html = view('other.reportForParent', $data);
        return ['title' => $data['title'], 'report' => $this->renderPdf($html)];
    }

    public function testAction()
    {
        $report = $this->generateReport(1, 1, "2018-12-01", "2018-12-30")['report'];
        return response($report)->header('Content-type', 'application/pdf');
    }
}
