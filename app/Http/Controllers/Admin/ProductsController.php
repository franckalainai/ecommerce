<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function products(){
        $products = Product::get();
        $products = json_decode($products);
        dd($products);
        //return view('admin.products.products');
    }
}
