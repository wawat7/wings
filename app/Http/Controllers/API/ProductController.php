<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    public function getById($productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            throw new NotFoundHttpException("product not found");
        }

        return response()->json($product, 200);
    }
}
