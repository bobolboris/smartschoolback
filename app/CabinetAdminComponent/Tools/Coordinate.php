<?php

namespace App\CabinetAdminComponent\Tools;

class Coordinate
{
    protected $x;
    protected $y;
    protected $alphabet;

    protected function divideLettersAndNumbers($coordinates)
    {
        for ($i = 0; $i < mb_strlen($coordinates); $i++) {
            $symbol = mb_substr($coordinates, $i, 1);
            if (is_numeric($symbol)) {
                return (object)[
                    'x' => mb_substr($coordinates, 0, $i),
                    'y' => mb_substr($coordinates, $i),
                ];
            }
        }
        return null;
    }

    protected function parseX($x)
    {
        $xArr = [];

        for ($i = 0; $i < mb_strlen($x); $i++) {
            $symbol = mb_substr($x, $i, 1);
            $xArr[] = array_search($symbol, $this->alphabet);
        }

        return $xArr;
    }

    protected function parseCoordinate($coordinate)
    {
        $obj = $this->divideLettersAndNumbers($coordinate);

        $coordinates = new \stdClass();
        $coordinates->x = $this->parseX($obj->x);
        $coordinates->y = $obj->y;

        return $coordinates;
    }

    public function nextX()
    {
        $this->addToX(1);
    }

    public function nextY()
    {
        $this->addToY(1);
    }

//    public function previousX()
//    {
//        $this->subToX(1);
//    }

//    public function previousY()
//    {
//        $this->subToY(1);
//    }

    public function addToY($value)
    {
        $this->y += $value;
    }

    public function subToY($value)
    {
        $this->y -= $value;

        if ($this->y < 1) {
            $this->y = 1;
        }
    }

    public function addToX($value)
    {
        $index = count($this->x) - 1;
        $alphabetLastIndex = count($this->alphabet) - 1;

        $remainder = $value;

        while (true) {
            $sum = $this->x[$index] + $remainder;
            if ($sum > $alphabetLastIndex) {
                $coefficient = intdiv($sum, $alphabetLastIndex);
                $this->x[$index] = $sum - $coefficient * $alphabetLastIndex - $coefficient;
                $remainder = $coefficient - 1;
                $index--;

                if ($index == -1) {
                    array_unshift($this->x, 0);
                    $index = 0;
                }
            } else {
                $this->x[$index] = $sum;
                break;
            }
        }
    }

//    public function subToX($value)
//    {
//        $index = count($this->x) - 1;
//        $alphabetLastIndex = count($this->alphabet) - 1;
//
//        $remainder = $value;
//
//        while (true) {
//            $diff = $this->x[$index] - $remainder;
//            if ($diff < 0) {
//                $coefficient = intdiv(-$diff, $alphabetLastIndex);
//                $tmp = $coefficient * $alphabetLastIndex;
//                $this->x[$index] = ($alphabetLastIndex + $this->x[$index]) - $tmp;
//                $remainder -= $tmp;
//                $index--;
//
//                if ($index == -1) {
//                    //error
//                    break;
//                }
//
//            } else {
//                $this->x[$index] = $diff;
//                break;
//            }
//        }
//    }

    public function __toString()
    {
        if (!is_array($this->x) || $this->y == null) {
            return '';
        }

        return $this->getX() . $this->getY();
    }

    public function __construct($coordinate)
    {
        $this->alphabet = range('A', 'Z');
        $this->setCoordinate($coordinate);
    }

    public function setCoordinate($coordinate)
    {
        $coordinates = $this->parseCoordinate($coordinate);
        $this->x = $coordinates->x;
        $this->y = $coordinates->y;
    }

    public function setX($x)
    {
        $this->x = $this->parseX($x);
    }

    public function setY($y)
    {
        $this->y = $y;
    }

    public function getX()
    {
        $value = '';

        foreach ($this->x as $x) {
            $value .= $this->alphabet[$x];
        }

        return $value;
    }

    public function getY()
    {
        return $this->y;
    }

}
