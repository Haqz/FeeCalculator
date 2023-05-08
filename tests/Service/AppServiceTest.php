<?php

namespace App\Tests\Service;

use App\Service\AppService;
use PHPUnit\Framework\TestCase;

class AppServiceTest extends TestCase
{
    private AppService $appService;
    private $feeArray;

    public function __construct()
    {
        parent::__construct();
        $this->appService = new AppService();
        $this->feeArray = [
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
        ];
    }

    public function testCalculate()
    {
        $result = $this->appService->calculate(1200, 12);
        $this->assertEquals(1260, $result);
    }

    public function testLinearSlope()
    {
        $slope = $this->appService->linearSlope(90, 50, 2000, 1000);
        $this->assertEquals(0.04, $slope);
    }

    public function testLinearValue()
    {
        $slope = $this->appService->linearSlope(90, 50, 2000, 1000);
        $value = $this->appService->linearValue(50, 1000, 1200, $slope);
        $this->assertEquals(58.0, $value);
    }

    public function testFindClosestKey()
    {
        $result = $this->appService->findClosestKey($this->feeArray, 17432);
        $this->assertEquals(17000, $result);
    }
}
