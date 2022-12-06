@extends('navbar.navbar')
@section('content')


  <div class="cart">
    <div class="cart-top">
      <h2 class="cart-top-title">Checkout</h2>
      <div class="cart-top-info">3 items</div>
    </div>
    @php
       $total=0;
      $khalti=0;
    @endphp
   
@foreach ($cart as $cart)

 @php
   $price='0';
   $price= $cart->quantity * $cart->price;
   $total= $price + $total;
   $khalti=$total*100;
 @endphp
    <ul>
      <li class="cart-item">
        <span class="cart-item-pic">
          <img src="{{$cart->image}}">
        </span>
        {{$cart->name}}
       
        <span class="cart-item-desc">{{$cart->description}}</span>
        
        <a href="{{route('deletecart',$cart->id)}}" class="cart-button">Delete</a>
        <span class="cart-item">Quantity:{{$cart->quantity}}</span><br>
        <span class="cart-item-price">Rs.{{$price}} </span>
      </li>
      
    </ul>

@endforeach

    <div class="cart-bottom">
      Total: {{$total}}
      <a href="#" id="payment-button" class="cart-button">Pay With Khalti</a>
    </div>
  </div>
  

  <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>


  <script>
   var config = {
       // replace the publicKey with yours
       "publicKey": "test_public_key_99697f8fd7fc41e8b922cb5f84cf4e82",
       "productIdentity": "1234567890",
       "productName": "Dragon",
       "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
       "paymentPreference": [
           "KHALTI",
           "EBANKING",
           "MOBILE_BANKING",
           "CONNECT_IPS",
           "SCT",
           ],
       "eventHandler": {
           onSuccess (payload) {
               // hit merchant api for initiating verfication
               console.log(payload);
               if(payload.idx)
               {
                   $.ajaxSetup({
                       headers:{
                       'X-CSRF-TOKEN': '{{csrf_token()}}',
                       }
           });
           $.ajax({
               method:'GET',
               url: "{{route('khalti.verify')}}",
               data: payload,
               SUCCESS: function (response)
               {
                   console.log('successfully paid');
                  //  window.location = '/sucesspage';
               },
               error: function(data)
               {
                   console.log(data.message);
               }
           });
               }
           },
           onError (error) {
               console.log(error);
           },
           onClose () {
               console.log('widget is closing');
           }
       }
   };
 
   var checkout = new KhaltiCheckout(config);
   var btn = document.getElementById("payment-button");
   btn.onclick = function () {
       // minimum transaction amount must be 10, i.e 1000 in paisa.
       checkout.show({amount: {{1000}}});
   }
 </script>
 {{-- khalti end --}}
@endsection