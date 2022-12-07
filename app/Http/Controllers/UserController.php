<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class UserController extends Controller
{
    public function index(){
        return view('dashboard');
    }
    public function products(){
        // $products =Products::paginate(3);
        $products =Products::all();

        return view('products',compact('products'));
    }


    public function cart(){
            $cart= Cart::where('userid',auth()->user()->id)->get();

            return view('cart',compact('cart'));
      
        
       
    }
 public function order()
 {
    $order =Order::where('userid',auth()->user()->id)->get();   
    return view('orders',compact('order'));
 }
    public function addcart(Request $request){
        $cart = Cart::where('userid',auth()->user()->id)->where('productid',$request->productid)->count();
        if($cart > 0)
        {
           dd('already in cart');
        }
        else
        {
        //     $data = $request->all();
        // Cart::create($data);
        
        $cart =new cart();
        $cart->userid = $request->userid;
        $cart->productid = $request->productid;
        $cart->name = $request->name;
        $cart->price = $request->price;
        $cart->quantity = $request->quantity;
        $cart->description = $request->description;
        $cart->image = $request->image;
        $cart->total = $request->price * $request->quantity;
        $cart->save();

        }
        
        return redirect(route('cart'));

    }
    public function delete($cartid){
        $id= Cart::find($cartid);
        $id->delete($id->id);
        return redirect(route('cart'));

    }

   
}
