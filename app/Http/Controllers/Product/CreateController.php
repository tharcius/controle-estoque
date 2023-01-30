<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use Illuminate\Http\JsonResponse;

class CreateController extends Controller
{
    /**
     * Register a new product.
     * When a new product is register, a stock to him is created with zero quantity a the value specified, if no value
     * is specified, its assume the 0 value.
     *
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function __invoke(CreateRequest $data): JsonResponse
    {
        $product = $this->product->createProduct(product:  $data->only(['name', 'value']));
        $responseData = [
            'data' => !empty($product) ? $product : null,
            'error' => $product['error'] ?? null,
        ];
        $responseStatusCode = !empty($product['error']) ? 422 : 200;

        return response()->json($responseData, $responseStatusCode);
    }
}
