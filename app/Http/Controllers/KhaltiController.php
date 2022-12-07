<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class KhaltiController extends Controller
{
    public function verify(Request $request)
    {
        $args = http_build_query(array(
            'token' => $request->token,
            'amount'  => 1000
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key test_secret_key_75e2a1f970ba44ed933a5383475eef0b'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status_code == 200) {
            
            return response()->json(['success' => 1,'redirectto' => '/user/successpage',]);
            // return response()->json(['success' => 1,'redirecto' => route('done')]);
            
        } else {
            return response()->json([
                'message' => 'Something Went Wrong',
            ]);
        }

    }
   
    
    
    public function successpage(){
        $cart= Cart::where('userid',auth()->user()->id)->get();

foreach($cart as $cart){
        $order =new Order();
        $order->userid = $cart->userid;
        $order->productid = $cart->productid;
        $order->name = $cart->name;
        $order->image = $cart->image;
        $order->quantity = $cart->quantity;
        $order->save();
    }
    $userid = Cart::where('userid',auth()->user()->id)->delete();
    // $userid = Cart::where(auth()->user()->id); ;
    // $userid->delete($userid->userid);
        return redirect(route('order'));
    }
}
