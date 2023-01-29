<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ValidateStockController extends Controller
{
    public function __construct(private Product $product)
    {
    }

    /**
     *
     */
    public function __invoke(): JsonResponse
    {
        $products = $this->product->with('historics')->get();
        $errorsToReport = [];
        foreach ($products as $product) {
            $currentQuantity = $product->quantity;
            $productInputHistoric = $product->historics()->input()->sum('quantity');
            $productOutputHistoric = $product->historics()->output()->sum('quantity');
            $historicQuantity = $productInputHistoric - $productOutputHistoric;

            if ($currentQuantity != $historicQuantity) {
                $this->product->update(['quantity' => $historicQuantity]);
                $errorsToReport[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $product->quantity,
                    'historic_quantity' => $historicQuantity,
                ];
            };
        }
        if (empty($errorsToReport)) {
            return response()->json(['data' => null, 'message' => 'No stock inconsistency found', 'error' => null], 200);
        }
        return response()->json(['data' => $errorsToReport, 'message' => 'Stock inconsistency found and correct', 'error' => null], 200);
    }
}
