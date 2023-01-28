<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __construct(private Product $product)
    {
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function __invoke($id): JsonResponse
    {
        $product = $this->product->find($id);
        if ($product->delete()){
            return response()->json(['data' => $product, 'error' => null], 200);
        }
        return response()->json(['data' => null, 'error' => ['error' => 'Failure during deleting']], 422);
    }
}
