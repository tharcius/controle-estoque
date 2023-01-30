<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    /**
     * Show details of a specified product
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        $product = $this->product->getProductById(id: $id);
        $responseData = [
            'data' => empty($product['error']) ? $product : null,
            'error' => $product['error'] ?? null,
        ];
        $responseStatusCode = empty($product['error']) ? 200 : 422;

        return response()->json($responseData, $responseStatusCode);
    }
}
