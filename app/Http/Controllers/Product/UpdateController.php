<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    /**
     * Update details (name, value) of a product
     * @param CreateRequest $request
     * @param int $id
     * @return JsonResponse
     */

    public function __invoke(CreateRequest $request, int $id): JsonResponse
    {
        $product = $this->product->updateProduct(id: $id, data:  $request->only(['name', 'value']));
        $responseData = [
            'data' => empty($product['error']) ? $product : null,
            'error' => $product['error'] ?? null,
        ];
        $responseStatusCode = empty($product['error']) ? 200 : 422;

        return response()->json($responseData, $responseStatusCode);
    }
}
