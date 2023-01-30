<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DeleteController extends Controller
{
    /**
     * Delete a product.
     *
     * @param $id
     * @return JsonResponse
     */
    public function __invoke($id): JsonResponse
    {
        $product = $this->product->deleteProduct(id: $id);
        if ($product) {
            return response()->json(['data' => $product, 'error' => null], 200);
        }
        return response()->json(['data' => null, 'error' => ['error' => 'Failure during deleting']], 422);
    }
}
