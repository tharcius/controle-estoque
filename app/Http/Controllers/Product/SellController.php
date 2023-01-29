<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\FlowRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class SellController extends Controller
{
    public function __construct(private Product $product)
    {
    }

    /**
     * @param FlowRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function __invoke(FlowRequest $request, $id): JsonResponse
    {
        $data = $request->only(['details', 'value', 'quantity']);
        $data['type'] = 'output';
        if ($product = $this->product->find($id)) {
            $product->update($data);
            $product->historics()->create($data);
            $result = $this->product->with('historic:id,quantity,value,product_id')->limit(1)->find($id);
            return response()->json(['data' => $result, 'error' => null], 201);
        }
        return response()->json(['data' => null, 'error' => ['error' => 'Failure during registration']], 422);
    }
}
