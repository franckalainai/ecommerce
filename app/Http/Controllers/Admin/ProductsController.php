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

        if($request->isMethod('post')){
            $data = $request->all();

            if(empty($data['category_discount'])){
                $data['category_discount'] = "";
            }

            if(empty($data['description'])){
                $data['description'] = "";
            }

            if(empty($data['meta_title'])){
                $data['meta_title'] = "";
            }

            if(empty($data['meta_description'])){
                $data['meta_description'] = "";
            }

            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = "";
            }

            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',
                'category_image' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000'
            ];

            $customMessages = [
                'category_name.required' => 'Le nom obligatoire',
                'category_name.regex' => 'veuillez entrer un nom valide',
                'section_id.required' => 'La section est obligatoire',
                'url.required' => 'L\'Url est obligatoire',
                'category_image.image' => 'Veuillez uploader une image valide'
            ];
            $this->validate($request, $rules, $customMessages);

            // Upload category image
            if($request->hasFile('category_image')){
                $image_tmp = $request->file('category_image');
                if($image_tmp->isValid()){
                    // get image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate new image name
                    $imageName = rand(111, 9999).'.'.$extension;
                    $imagePath = 'images/category_images/'.$imageName;
                    // Upload the image
                    Image::make($image_tmp)->save($imagePath);

                    $product->category_image = $imageName;
                }
            }

            $product->parent_id = $data['parent_id'];
            $product->section_id = $data['section_id'];
            $product->product_name = $data['product_name'];
            $product->product_discount = $data['product_discount'];
            $product->description = $data['description'];
            $product->url = $data['url'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->status = 1;
            //dd($data);
            $product->save();

            Session::flash('success_message', $message);
            return redirect('admin/products');
        }
        return view('admin.products.add_edit_product')->with(compact('title','fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray'));
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
