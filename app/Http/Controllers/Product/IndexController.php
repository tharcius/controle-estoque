<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    /**
     * Return all products registered in the system
     *
     * @return JsonResponse()
     */

    public function __invoke(): JsonResponse
    {
        $product = $this->product->getAllProducts();

        return response()->json($product);
    }
}
