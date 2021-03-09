<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Section;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function products(){
        Session::put('page', 'products');
        $products = Product::with(['category', 'section'])->get();
        //$products = json_decode($products);
        //dd($products);
        return view('admin.products.products')->with(compact('products'));
    }

    public function addEditProduct(Request $request, $id=null){
        if($id == null){
            $title = "Ajouter produit";
            $product = new Product();
            $message = "produit crée avec succès";
        }else{
            $title = "Modifier produit";
            $message = "produit modifié avec succès";
        }

        // Filter Arrays
        $fabricArray = array('Coton', 'Polyester', 'Wool');
        $sleeveArray = array('Full Sleev', 'Half Sleeve', 'Short Sleeve', 'Sleeveless');
        $patternArray = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $fitArray = array('Regular', 'Slim');
        $occasionArray = array('Casual', 'Formal');

        // Sections with categories and subcategories
        $categories = Section::with('categories')->get();
        //$categories = json_decode($categories);
        //dd($categories);

        return view('admin.products.add_edit_product')->with(compact('title','fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'categories'));
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
