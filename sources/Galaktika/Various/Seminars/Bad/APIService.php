<?php

namespace Galaktika\Various\Seminars\Bad;

use GuzzleHttp\Client;

class APIService
{
    private DBService $dbService;

    private Client $client;

    public function getApiData(string $filter) : array
    {
        $response = $this->client->request('GET', 'api_endpoint/products', [
            'query' => ['filter'=>$filter]
        ]);

        $json = $response->getBody()->getContents();


        return json_decode($json, true);
    }


    /**
     * @param string $filter
     * @return Product[]
     */
    public function getProducts(string $filter) : array {

        $data = $this->getApiData($filter);

        $ids = [];
        foreach ($data as $product) {
            $ids[] = $product['id'];
        }
        $products = $this->dbService->getProducts($ids);

        /** @var Product[] $productsMap */
        $productsMap = [];
        foreach ($products as $product) {
            $productsMap[$product['id']] = $product;
        }

        foreach ($data as $product) {
            $productsMap[$product['id']]->quantity = $product['amount'];
        }

        return $products;
    }
}