<?php

namespace App\Http\Controllers;

use App\Facades\ApiResponse;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Categories extends BaseController
{
    /**
     * Get list of all categories
     * GET /api/categories/list
     * @return JsonResponse
     */
    public function getCategoryList(): JsonResponse
    {
        return ApiResponse::success(Category::all()->toArray());
    }
}
