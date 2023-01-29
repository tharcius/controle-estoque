<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class CreateController extends Controller
{
    public function __construct(private Product $product)
    {
    }

    /**
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function __invoke(CreateRequest $request): JsonResponse
    {
        $data = $request->only(['name', 'value']);
        if ($product = $this->product->create($data)) {
            $product->stock()->create(['quantity' => 0]);
            return response()->json(['data' => $product, 'error' => null], 201);
        }
        return response()->json(['data' => null, 'error' => ['error' => 'Failure during registration']], 422);
    }
}
