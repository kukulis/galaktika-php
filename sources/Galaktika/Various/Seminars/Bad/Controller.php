<?php

namespace Galaktika\Various\Seminars\Bad;

use Psr\Http\Message\RequestInterface;

class Controller
{
    private CalculatorService  $calculator;

    /**
     * @param CalculatorService $calculator
     */
    public function __construct(CalculatorService $calculator)
    {
        $this->calculator = $calculator;
    }

    public function badGetProducts(RequestInterface $request) {
        $params = $request->getBody();
        $this->calculator->getProducts($params);
    }
}