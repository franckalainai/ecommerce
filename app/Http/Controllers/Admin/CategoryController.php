<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function categories(){
        Session::put('page', 'categories');
        $categories = Category::get();
        //$categories = json_decode($categories);
        //dd($categories);
        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data["status"]=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id=null){
        if($id == null){
            $title = "Add Category";
            // Add Category Functionality
            $category = new Category;
        }else{
            $title = "Edit Category";
            // Edit Category Functionality
        }

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

                    $category->category_image = $imageName;
                }
            }

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            //dd($data);
            $category->save();

            Session::flash('success_message', 'categorie crée avec succès');
            return redirect('admin/categories');
        }

        // Get all sections
        $getSections = Section::get();
        return view('admin.categories.add_edit_category')->with(compact('title', 'getSections'));
    }
}
