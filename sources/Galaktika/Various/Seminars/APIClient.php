<?php

namespace Galaktika\Various\Seminars;

use GuzzleHttp\Client;

class APIClient
{
    private Client $client;
    /**
     * @return Product[]
     */
    public function getProducts(string $filter) : array
    {
        $response = $this->client->request('GET', 'api_endpoint/products', [
            'query' => ['filter'=>$filter]
        ]);

        $json = $response->getBody()->getContents();


        return $this->transformToProducts($json);
    }

    /**
     * @return Product[]
     */
    public function transformToProducts(string $json) : array {
        // TODO transform JSON to products list
        return [];
    }
}