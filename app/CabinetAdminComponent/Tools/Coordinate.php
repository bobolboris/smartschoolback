<?php

namespace App\CabinetAdminComponent\Tools;

class Coordinate
{
    protected $x;
    protected $y;
    protected $alphabet;
    protected $valueCache;

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

    public function setCoordinate($coordinate)
    {
        $coordinates = $this->parseCoordinate($coordinate);
        $this->x = $coordinates->x;
        $this->y = $coordinates->y;
        $this->valueCache->isChanged = true;
    }

    protected function parseCoordinate($coordinate)
    {
        $obj = $this->divideLettersAndNumbers($coordinate);

        $coordinates = new \stdClass();
        $coordinates->x = $this->parseX($obj->x);
        $coordinates->y = $obj->y;

        return $coordinates;
    }

    protected function parseX($x)
    {
        $value = 0;
        for ($i = 0; $i < mb_strlen($x); $i++) {
            $symbol = mb_substr($x, $i, 1);
            $index = array_search($symbol, $this->alphabet) + 1;
            $factor = pow(count($this->alphabet), mb_strlen($x) - $i - 1);
            $value += $index * $factor;
        }
        return $value;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getX()
    {
        if (!$this->valueCache->isChanged) {
            return $this->valueCache->value;
        }
        $value = $this->x;
        $string = '';

        while ($value > count($this->alphabet)) {
            $newValue = intdiv($value - 1, count($this->alphabet));
            $remainder = $value - $newValue * count($this->alphabet);
            $string = $this->alphabet[$remainder - 1] . $string;
            $value = $newValue;
        }

        if ($value >= 0) {
            $string = $this->alphabet[$value - 1] . $string;
        }

        return $string;
    }

    public function __toString()
    {
        if ($this->x == null || $this->y == null) {
            return '';
        }

        if (!$this->valueCache->isChanged) {
            return $this->valueCache->value;
        }

        $this->valueCache->value = $this->getX() . $this->getY();
        $this->valueCache->isChanged = true;

        return $this->valueCache->value;
    }

    public function addToX($value)
    {
        $this->valueCache->isChanged = true;
        $this->x += $value;
    }

    public function subToX($value)
    {
        $this->valueCache->isChanged = true;
        if ($this->x > 0) {
            $this->x -= $value;
        }
    }

    public function addToY($value)
    {
        $this->valueCache->isChanged = true;
        $this->y += $value;
    }

    public function subToY($value)
    {
        $this->valueCache->isChanged = true;
        $this->y -= $value;

        if ($this->y < 1) {
            $this->y = 1;
        }
    }

    public function nextX()
    {
        $this->addToX(1);
    }

    public function nextY()
    {
        $this->addToY(1);
    }

    public function previousX()
    {
        $this->subToX(1);
    }

    public function previousY()
    {
        $this->subToY(1);
    }

    public function __construct($coordinate)
    {
        $this->alphabet = range('A', 'Z');
        $this->valueCache = (object)['isChanged' => true, 'value' => ''];
        $this->setCoordinate($coordinate);
    }
}
