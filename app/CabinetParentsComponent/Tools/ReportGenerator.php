<?php

namespace App\CabinetParentsComponent\Tools;

use Alexusmai\Ruslug\RuslugFacade;
use App\MainComponent\Access;
use App\MainComponent\Child;
use App\MainComponent\Parents;
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
            ->get();

        $child = Child::find($childId);
        $parent = Parents::find($parentId);

        $dates = [];

        $previousDate = null;

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

        $firstSymbolNameChild = substr($child->name, 0, 2);
        $firstSymbolPatronymicChild = substr($child->name, 0, 2);

        $schoolName = $child->school->name;
        $title = "report $child->surname $firstSymbolNameChild$firstSymbolPatronymicChild $schoolName";
        $title = str_replace(' ', '_', $title);
        $title = RuslugFacade::make($title);

        return [
            'title' => $title,
            'startDate' => $startDate,
            'finishDate' => $finishDate,
            'dateFormation' => date("Y-m-d"),
            'class' => $child->school_class->name,
            'school' => $child->school_class->school->name,
            'address' => explode(',', $child->school->address),
            'fullNameChild' => "$child->surname $child->name $child->patronymic",
            'fullNameParent' => "$parent->surname $parent->name $parent->patronymic",
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
        return response($this->generateReport(1, 1, "2018-12-01", "2018-12-30")['report'])
            ->header('Content-type', 'application/pdf');
    }
}
