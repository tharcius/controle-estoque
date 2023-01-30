<?php

namespace Tests\Feature;

it('has index in products api', function () {
    $this->getJson('/products')->assertStatus(200);
});

it('should return an JSON with the register or the error', function (
    array $dataset,
    array $result,
) {
    $response = $this->postJson('/products', $dataset, $result);
    $response->assertJson($result);
})->with(
    [
        'test #01' =>
            [
                'dataset' => [
                    'name' => 'New Product 01'
                ],
                'result' => [
                    'data' => [
                        "quantity" => 0,
                        "product_id" => 1,
                        "id" => 1,
                        "name" => "New Product 01"
                    ],
                    'error' => null
                ]
            ],

        'test #02' =>
            [
                'dataset' => [
                    'name' => 'New Product 02',
                    'value' => '371.23'
                ],
                'result' => [
                    'data' => [
                        "quantity" => 0,
                        "product_id" => 1,
                        "id" => 1,
                        "name" => "New Product 02",
                    ],
                    'error' => null
                ]
            ],

        'test #03' =>
            [
                'dataset' => [
                    'name' => 'New Product 03',
                    'value' => '371.23',
                    'quantity' => 8
                ],
                'result' => [
                    'data' => [
                        'name' => 'New Product 03',
                        'id' => 1,
                        'quantity' => 0
                    ],
                    'error' => null
                ]
            ],

        'test #04' =>
            [
                'dataset' => [
                ],
                'result' => [
                    "message" => "The name field is required.",
                    "errors" => [
                        "name" => [
                            "The name field is required."
                        ]
                    ]
                ]
            ],
    ]
);
