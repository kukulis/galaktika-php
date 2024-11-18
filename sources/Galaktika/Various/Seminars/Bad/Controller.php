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

    /**
     * @param RequestInterface $request
     * @return Product[]
     */
    public function badGetProducts(RequestInterface $request) : array {
        $params = $request->getBody();
        return $this->calculator->getProducts($params);
    }
}