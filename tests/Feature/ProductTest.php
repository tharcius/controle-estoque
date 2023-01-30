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

it('has to buy a product with id 5', function () {
    Product::factory(10)->create();
    $product = $this->postJson('/products/5/buy', ['value' => 150, 'quantity' => 8]);
    $product->assertJsonStructure(['data', 'error']);
    $product->assertValid('data,error', null);
    $product->assertJsonFragment(['data' => ['value' => 150.00, 'quantity' => 8]]);
});

it('has to sell a product with id 6', function () {
    Product::factory(10)->create();
    $this->postJson('/products/6/buy', ['value' => 150, 'quantity' => 8]);
    $product = $this->postJson('/products/+/sell', ['value' => 200, 'quantity' => 1]);
    $product->assertJsonStructure(['data', 'error']);
    $product->assertValid('data,error', null);
    $product->assertJsonFragment(['data' => ['value' => 200.00, 'quantity' => 7]]);
});

