<?php

namespace Galaktika\Various\Seminars\Bad;

class CalculatorService
{
    private float $vatPercent;
    private APIService  $apiService;

    /**
     * @param float $vatPercent
     * @param APIService $apiService
     */
    public function __construct(float $vatPercent, APIService $apiService)
    {
        $this->vatPercent = $vatPercent;
        $this->apiService = $apiService;
    }


    /**
     * @param string $requestData
     * @return Product[]
     */
    public function getProducts(string $requestData) : array {
        $products = $this->apiService->getProducts($requestData);

        foreach ($products as $product) {
            $product->price = $product->price * ( 1 + $this->vatPercent);
        }

        return $products;
    }
}