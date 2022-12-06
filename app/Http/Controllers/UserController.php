<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class UserController extends Controller
{
    public function index(){
        return view('dashboard');
    }
    public function products(){
        $products =Products::paginate(3);
        return view('products',compact('products'));
    }


    public function cart(){
            $cart= Cart::where('userid',auth()->user()->id)->get();

            return view('cart',compact('cart'));
      
        
       
    }
 public function order()
 {
    return view('order');
 }
    public function addcart(Request $request){
        $cart = Cart::where('userid',auth()->user()->id)->where('productid',$request->productid)->count();
        if($cart > 0)
        {
            dd('already in cart');
        }
        else
        {
            $data = $request->all();
        Cart::create($data);
        }
        
        return redirect(route('cart'));

    }
    public function delete($cartid){
        $id= Cart::find($cartid);
        $id->delete($id->id);
        return redirect(route('cart'));

    }
}
