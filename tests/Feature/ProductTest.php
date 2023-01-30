<?php

use App\Models\Product;

it('has to return the quantity of products in index', function () {
    Product::factory(10)->create();
    $this->getJson('/products')->assertJsonCount(10);
});

it('has to show the product with id 2', function () {
    Product::factory(10)->create();
    $product = $this->getJson('/products/2');
    $product->assertJsonStructure(['data', 'error']);
    $product->assertValid('data,error', null);
});

it('has to update the product with id 3', function () {
    Product::factory(10)->create();
    $product = $this->patchJson('/products/3', ['name' => 'Product 03', 'value' => 500]);
    $product->assertJsonStructure(['data', 'error']);
    $product->assertJson([
        'data' => [
            'name' => 'Product 03',
            'id' => 3,
            'value' => 500.00,
            'quantity' => 0
        ],
        'error' => null
    ]);
});

it('has to delete the product with id 4', function () {
    Product::factory(10)->create();
    $product = $this->deleteJson('/products/4');
    $product->assertJsonStructure(['data', 'error']);
    $product->assertValid('data,error', null);
});

it('has to delete the product with id 14 and return an error', function () {
    Product::factory(10)->create();
    $product = $this->deleteJson('/products/14');
    $product->assertJsonStructure(['data', 'error']);
    $product->assertValid('data,error', 'Failure during deleting');
    $product->assertJson(['data' => null, 'error' => ['error' => 'Failure during deleting']]);
});

