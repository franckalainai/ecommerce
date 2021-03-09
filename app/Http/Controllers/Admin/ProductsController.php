<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function products(){
        Session::put('page', 'products');
        $products = Product::get();
        //$products = json_decode($products);
        //dd($products);
        return view('admin.products.products')->with(compact('products'));
    }

    public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data["status"]=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    public function deleteProduct($id){
        Product::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Le produit a été supprimée avec succès');

    }
}
