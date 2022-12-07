<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
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
    public function order()
    {
       $order =Order::all();   
       return view('admin.orders',compact('order'));
    }
    public function editproduct($productid){
$product=products::find($productid);
return view('admin.editproduct',compact('product'));

    }

    public function updateproduct(Request $request,$id){
        $product = Products::find($id);
        $data=$request->all();
        $product->update($data);
        return redirect(route('products'));
    }

    public function deleteproduct($productid){
        $id= Products::find($productid);
        $id->delete($id->id);
        return redirect(route('products'));
    } 
    public function deleteorder($productid){
        $id= Order::find($productid);
        $id->delete($id->id);
        return redirect(route('allorders'));
    }
}

