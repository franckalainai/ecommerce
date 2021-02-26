<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.admin_dashboard');
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [
                'email.required' => 'l\'email est obligatoire',
                'email.email' => 'Veuillez fournir une adresse mail valide ',
                'password.required' => 'Le mot de passe est obligatoire'
            ];

            $this->validate($request, $rules, $customMessages);

            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'] ])){
                return redirect('admin/dashboard');
            }else{
                Session::flash('error_message', 'Invalid email or Password');
                return redirect()->back();
            }
        }
        return view('admin.admin_login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function settings(){
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.settings')->with(compact('adminDetails', $adminDetails));
    }

    public function checkCurrentPassword(Request $request){
        $data = $request->all();
        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
            echo "true";
        }else{
            echo "false";
        }
    }

    public function updateCurrentPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // check if current password is correct
            if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
                // check if new password is correct
                if($data['new_pwd'] == $data['confirm_pwd']){
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_pwd'])]);
                    Session::flash('success_message', 'Mot de passe modifié avec succès');
                }else{
                    $request->session()->flash('error_message', 'Les nouveaux mot de passe ne sont pas conforment');
                }
            }else{
                $request->session()->flash('error_message', 'Votre mot de passe courant est incorrect');
            }
            return redirect()->back();
        }
    }

    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
                'admin_image' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000'
            ];

            $customMessages = [
                'admin_name.required' => 'Le nom obligatoire',
                'admin_name.alpha' => 'veuillez entrer un nom valide',
                'admin_mobile.required' => 'Le mobile est obligatoire',
                'admin_mobile.numeric' => 'Veuillez entrer un numéro valide',
                'admin_image.image' => 'Veuillez uploader une image valide'
            ];
            $this->validate($request, $rules, $customMessages);

            // Upload image
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    // get image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate new image name
                    $imageName = rand(111, 9999).'.'.$extension;
                    $imagePath = 'images/admin_images/admin_photos/'.$imageName;
                    // Upload the image
                    Image::make($image_tmp)->save($imagePath);
                }else if(!empty($data['current_admin_image'])){
                    $imageName = $data['current_admin_image'];
                }else{
                    $imageName = "";
                }
            }


            // Update admin details
            Admin::where('email', Auth::guard('admin')->user()->email)
            ->update(['name' => $data['admin_name'], 'mobile' => $data['admin_mobile'], 'image' => $imageName]);
            Session::flash('success_message', 'Les infos de l\' admin ont été modifiée avec succès');
            return redirect()->back();
        }
        return view('admin.update_admin_details');
    }
}
