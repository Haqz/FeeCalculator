<?php

namespace App\Service;

class AppService
{
    private $arr;
    public function __construct()
    {
        $this->arr =
            [
                12 => [
                    1000 => 50,
                    2000 => 90,
                    3000 => 90,
                    4000 => 115,
                    5000 => 100,
                    6000 => 120,
                    7000 => 140,
                    8000 => 160,
                    9000 => 180,
                    10000 => 200,
                    11000 => 220,
                    12000 => 240,
                    13000 => 260,
                    14000 => 280,
                    15000 => 300,
                    16000 => 320,
                    17000 => 340,
                    18000 => 360,
                    19000 => 380,
                    20000 => 400
                ],
                24 => [
                    1000  => 70,
                    2000  => 100,
                    3000  => 120,
                    4000  => 160,
                    5000  => 200,
                    6000  => 240,
                    7000  => 280,
                    8000  => 320,
                    9000  => 360,
                    10000 => 400,
                    11000 => 440,
                    12000 => 480,
                    13000 => 520,
                    14000 => 560,
                    15000 => 600,
                    16000 => 640,
                    17000 => 680,
                    18000 => 720,
                    19000 => 760,
                    20000 => 800
                ]
            ]
        ;
    }

    public function linearSlope(float $upperValue, float $lowerValue, float $upperBound, float $lowerBound ) : float {
        return ($upperValue - $lowerValue) / ($upperBound - $lowerBound);
    }

    public function linearValue(float $lowerValue, float $lowerBound, float $point, float $slope) : float
    {
        return $lowerValue + $slope * ($point-$lowerBound);
    }

    public function calculate(float $amount, int $term) {
        $lowerKey = $this->findClosestKey($this->arr[$term], $amount);
        $upperKey = ($lowerKey+1000 > 20000) ? 1000 : $lowerKey+1000;
        $lowerValue = $this->arr[$term][$lowerKey];
        $upperValue = $this->arr[$term][$upperKey];
        $slope = $this->linearSlope($upperValue, $lowerValue, $upperKey, $lowerKey);
        $value = $this->linearValue($lowerValue, $lowerKey, $amount, $slope);
        return (round($amount + $value)%5 === 0) ? round($amount + $value) : round(($amount + $value+5/2)/5)*5;
    }

    function findClosestKey($arr, $targetValue) {
        $keys = array_keys($arr);
        $minDiff = PHP_INT_MAX;
        $closestKey = null;

        foreach ($keys as $key) {
            $diff = $targetValue - $key;
            if($diff < 0) continue;
            if ($diff < $minDiff) {
                $minDiff = $diff;
                $closestKey = $key;
            } elseif ($diff == $minDiff) {
                $closestKey = $key;
            }
        }

        return $closestKey;
    }
}