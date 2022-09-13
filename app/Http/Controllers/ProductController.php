<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Search Products
     * @param category_id, price
     */
    public function filterProduct(Request $request){
        $price = $request->query('price');
        $category = $request->query('category');
        $query = Product::select('sku', 'name', 'category', 'price');
        if($price){
            $query = $query->where('price', $price);
        }
        if($category){
            $query = $query->where('category', $category);
        }
        $products = $query->get();
        return response()->json(ProductResource::collection($products));
    }
}
