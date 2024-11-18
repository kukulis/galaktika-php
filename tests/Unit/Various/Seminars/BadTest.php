<?php

namespace Tests\Unit\Various\Seminars;

use Galaktika\Various\Seminars\Bad\APIService;
use Galaktika\Various\Seminars\Bad\CalculatorService;
use Galaktika\Various\Seminars\Bad\Controller;
use Galaktika\Various\Seminars\Bad\DBService;
use Galaktika\Various\Seminars\Bad\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;

class BadTest extends TestCase
{
    public function testBad()
    {
        $guzzleClient = $this->createMock(Client::class);

        // make call of controller from the guzzle client
        $guzzleClient->method('request')->willReturn(
            new Response(200, [],
                '[
                { "sku" : "x1234", "amount": "10" },
                { "sku" : "x1235", "amount": "20" },
                { "sku" : "x4567", "amount": "5" }
            ]'
            )
        );

        $pdo = $this->createMock(PDO::class);
        $pdoResult = $this->createMock(PDOStatement::class);
        $pdoResult->method('fetchAll')->willReturn([
            (new Product())->setSku("x1234")->setPrice(10),
            (new Product())->setSku("x1235")->setPrice(20),
            (new Product())->setSku("x4567")->setPrice(30),
        ]);
        $pdo->method('query')->willReturn($pdoResult);

        $dbService = new DBService($pdo);
        $apiService = new ApiService($dbService, $guzzleClient);
        $calculatorService = new CalculatorService(0.20, $apiService);
        $controller = new Controller($calculatorService);

        $products = $controller->badGetProducts(new Request('get', '/api', [], 'cosmetics'));

        $expectedProducts = [
            (new Product())->setSku("x1234")->setPrice(12)->setQuantity(10),
            (new Product())->setSku("x1235")->setPrice(24)->setQuantity(20),
            (new Product())->setSku("x4567")->setPrice(36)->setQuantity(5),
        ];

        $this->assertEquals($expectedProducts, $products);
    }
}