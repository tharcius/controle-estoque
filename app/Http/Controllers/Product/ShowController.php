<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    public function __construct(private Product $product, private Stock $stock)
    {
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        $product = $this->product->find($id);
        if (!$product) {
            return response()->json(['data' => null, 'error' => ['error' => 'Product not found']], 422);
        }
        return response()->json(['data' => $product, 'error' => null], 200);
    }
}
