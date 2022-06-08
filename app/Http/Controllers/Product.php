<?php

namespace App\Http\Controllers;

use App\Facades\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Product extends BaseController
{
    const MESSAGE_NOT_FOUND = 'Product not found!';
    const VALIDATION_RULES = [
        'name' => 'required|string|max:250',
        'category_id' => 'int',
        'sku' => 'required|string|max:50',
        'price' => 'numeric',
        'quantity' => 'int'
    ];

    /**
     * Get one product
     * GET /api/product/{id}
     *
     * @param  \App\Models\Product  $product
     * @return JsonResponse
     */
    public function getProduct(\App\Models\Product $product): JsonResponse
    {
        if (empty($product)) {
            return ApiResponse::error(self::MESSAGE_NOT_FOUND);
        }
        return ApiResponse::success($product->toArray());
    }

    /**
     * Create new product
     * POST /api/product/
     * @param  Request  $request
     * @return JsonResponse
     */
    public function createProduct(Request $request): JsonResponse
    {
        $productCreateArray = $request->validate(self::VALIDATION_RULES);

        $product = \App\Models\Product::create($productCreateArray);

        return ApiResponse::success($product->toArray());
    }

    /**
     * Update product
     * PUT /api/product/{id}
     * @param  Request  $request
     * @param  \App\Models\Product  $product
     * @return JsonResponse
     */
    public function saveProduct(Request $request, \App\Models\Product $product): JsonResponse
    {
        if (empty($product)) {
            return ApiResponse::error(self::MESSAGE_NOT_FOUND);
        }

        $productUpdateArray = $request->validate(self::VALIDATION_RULES);
        \App\Models\Product::where('id', $product->id)->update($productUpdateArray);

        return ApiResponse::success(\App\Models\Product::find($product->id)->toArray());
    }

    /**
     * Delete product
     * DELETE /api/product/{id}
     * @param  \App\Models\Product  $product
     * @return JsonResponse
     */
    public function deleteProduct(\App\Models\Product $product): JsonResponse
    {
        if (empty($product)) {
            return ApiResponse::error(self::MESSAGE_NOT_FOUND);
        }

        $product->delete();
        return ApiResponse::success([]);
    }
}
