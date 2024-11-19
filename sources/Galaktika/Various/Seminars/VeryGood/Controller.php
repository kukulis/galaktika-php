<?php

namespace Galaktika\Various\Seminars\VeryGood;

use Psr\Http\Message\RequestInterface;

class Controller
{
    private ApiClient $apiClient;
    private Repository $repository;

    private float $vat;

    public function __construct(ApiClient $apiClient, Repository $repository, float $vat)
    {
        $this->apiClient = $apiClient;
        $this->repository = $repository;
        $this->vat = $vat;
    }

    public function getProducts(RequestInterface $request): array
    {
        $params = $request->getBody();

        $apiProducts = $this->apiClient->getProducts($params);

        $skus = array_map(fn($product) => $product->sku, $apiProducts);

        $dbProducts = $this->repository->getProducts($skus);

        $apiProductsBySku = Indexer::reindex($apiProducts, fn(Product $product) => $product->sku);
        $apiQuantitiesBySku = array_map(fn(Product $apiProduct) => $apiProduct->quantity, $apiProductsBySku);

        $productsWithQuantities = array_map(
            fn($dbProduct) => $dbProduct->setQuantity($apiQuantitiesBySku[$dbProduct->sku] ?? -1),
            $dbProducts
        );

        return array_map(fn($product) => $product->applyVat($this->vat), $productsWithQuantities);
    }

    public function getProducts2(RequestInterface $request): array
    {
        $params = $request->getBody();

        $apiProducts = $this->apiClient->getProducts($params);

        $skus = array_map(fn($product) => $product->sku, $apiProducts);

        $dbProducts = $this->repository->getProducts($skus);

        Indexer::applyWhenMatch(
            $dbProducts,
            $apiProducts,
            fn($product) => $product->getSku(),
            fn($product) => $product->getSku(),
            fn(Product $dbProduct, Product $apiProduct) => $dbProduct->setQuantity($apiProduct->quantity));

        return array_map(fn($product) => $product->applyVat($this->vat), $dbProducts);
    }
}