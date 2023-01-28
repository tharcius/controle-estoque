<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    public function __construct(private Product $product)
    {
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        if ($product = $this->product->find($id)) {
            return response()->json(['data' => $product, 'error' => null], 200);
        }
        return response()->json(['data' => null, 'error' => ['error' => 'Failure during registration']], 422);
    }
}
