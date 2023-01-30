<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ValidateStockController extends Controller
{
    /**
     * Its use the historic registers of products to validade the stock quantity, if its found any inconsistency its
     * update the stock based in historic
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $products = Product::with('historics')->get();
        $errorsToReport = [];
        foreach ($products as $product) {
            $currentQuantity = $product->quantity;
            $productInputHistoric = $product->historics()->input()->sum('quantity');
            $productOutputHistoric = $product->historics()->output()->sum('quantity');
            $historicQuantity = $productInputHistoric - $productOutputHistoric;

            if ($currentQuantity != $historicQuantity) {
                $product->stock->update(['quantity' => $historicQuantity]);
                $errorsToReport[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $product->quantity,
                    'historic_quantity' => $historicQuantity,
                ];
            };
        }

        $message = empty($errorsToReport)
            ? 'No stock inconsistency found'
            : 'Stock inconsistency found and corrected';

        return response()->json([
            'data' => $errorsToReport,
            'message' => $message,
            'error' => null
        ], 200);
    }
}
