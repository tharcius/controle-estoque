<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\FlowRequest;
use Illuminate\Http\JsonResponse;

class SellController extends Controller
{
    /**
     * Add products to the stock.
     * When you sell some product, its decrements the quantity to stock and update the price
     * @param FlowRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function __invoke(FlowRequest $request, int $id): JsonResponse
    {
        $data = $request->only(['details', 'value', 'quantity']);
        $product = $this->product->flowProduct(id: $id, data: $data);
        $responseData = [
            'data' => empty($product['error']) ? $product : null,
            'error' => $product['error'] ?? null,
        ];
        $responseStatusCode = !empty($product['error']) ? 422 : 200;

        return response()->json($responseData, $responseStatusCode);
    }
}
