<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\FlowRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class BuyController extends Controller
{
    public function __construct(private Product $product)
    {
    }

    /**
     * @param FlowRequest $request
     * @param int $id
     * @return JsonResponse
     */

    public function __invoke(FlowRequest $request, int $id): JsonResponse
    {
        $data = $request->only(['details', 'value', 'quantity']);
        $data['type'] = 'input';
        $product = $this->product->with('stock')->find($id);

        if (!$product) {
            return response()->json(['data' => null, 'error' => ['error' => 'Failure during registration']], 422);
        }

        $product->update($data);
        $product->historics()->create($data);
        $product->stock->update(['quantity' => ($product->stock->quantity + $data['quantity'])]);
        $result = $this->product->with(['historic:id,quantity,value,product_id', 'stock'])->find($id);
        return response()->json(['data' => $result, 'error' => null], 201);
    }
}
