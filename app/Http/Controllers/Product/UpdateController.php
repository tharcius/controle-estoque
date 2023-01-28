<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __construct(private Product $product)
    {
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(Request $request, int $id): JsonResponse
    {
        $data = $request->only(['name', 'value']);
        $product = $this->product->find($id);
        if ($product->update($data)){
            return response()->json(['data' => $product, 'error' => null], 200);
        }
        return response()->json(['data' => null, 'error' => ['error' => 'Failure during registration']], 422);
    }
}
