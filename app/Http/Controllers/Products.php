<?php

namespace App\Http\Controllers;

use App\Facades\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class Products extends BaseController
{
    /**
     * Get list of all products
     * GET /api/products/list
     * @return JsonResponse
     */
    public function getProductList(): JsonResponse
    {
        return ApiResponse::success(Product::all()->toArray());
    }

    /**
     * Get value of all products
     * GET /api/products/value
     * @return JsonResponse
     */
    public function getProductValue(): JsonResponse
    {
        $result = Product::select(DB::raw('sum(price * quantity) as value'))->first();
        return ApiResponse::success($result->toArray());
    }
}
