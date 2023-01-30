<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductById(int $id);
    public function deleteProduct(int $id);
    public function createProduct(array $product);
    public function updateProduct($id, array $data);
    public function flowProduct(int $id, array $data, string $type = 'output');
}
