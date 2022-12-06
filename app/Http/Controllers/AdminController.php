<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
       
        return view('admin.home');
    }
    public function user(){
        return view('admin.user');
    }
    public function addproduct(){
        $category =Category::all();
        return view('admin.addproduct',compact('category'));
    }
    public function products(){
        $products =Products::paginate(3);
        return view('admin.products',compact('products'));
    }
    public function storeproduct(Request $request){
        $data = $request->all();
            // $data = $request->validate([
            //     'name'=>'required',
            //     'category'=>'required',
            //     'price'=>'required',
            //     'image'=>'required',
            //     'description'=>'required',
            // ]);
        Products::create($data);
        return redirect(route('products'));
    }
    public function categoryadd(Request $request){
        $data =$request->all([
            
        ]);
        Category::create($data);
        return redirect(route('addproduct'));

    }

}
