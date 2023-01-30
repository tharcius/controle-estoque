<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\FlowRequest;
use Illuminate\Http\JsonResponse;

class BuyController extends Controller
{
    /**
     * Add products to the stock.
     * When you buy some product, its add the quantity to stock and update the price
     *
     * @param FlowRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(FlowRequest $request, int $id): JsonResponse
    {
        $data = $request->only(['details', 'value', 'quantity']);
        $product = $this->product->flowProduct(id: $id, data: $data, type: 'input');
        $responseData = [
            'data' => empty($product['error']) ? $product : null,
            'error' => $product['error'] ?? null,
        ];
        $responseStatusCode = !empty($product['error']) ? 422 : 200;

        return response()->json($responseData, $responseStatusCode);
    }
}
