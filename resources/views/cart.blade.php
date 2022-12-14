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
   $total= $cart->total + $total;
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
        <span class="cart-item-price">Rs.{{$cart->total}} </span>
      </li>
      
    </ul>

@endforeach

    <div class="cart-bottom">
      Total: {{$total}}
      <a href="#" id="payment-button" class="cart-button">Pay With Khalti</a>
      <a href="{{route('successpage')}}" class="hover:text-white">Order</a>

    </div>
  </div>
 

  <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
  <script>
    var config = {
        // replace the publicKey with yours
        // "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a390234",
        "publicKey": "test_public_key_99697f8fd7fc41e8b922cb5f84cf4e82",
        "productIdentity":" {{auth()->user()->id}}",
        "productName": "{{auth()->user()->name}}",
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
                            'X-CSRF-TOKEN' : '{{csrf_token()}}',
                        }
                    });


                    $.ajax({
                         method: 'POST', 
                         url: "{{route('khalti.verify')}}", 
                         data: payload, 
                         success: function(response) 
                         {       
                                         
                            console.log(response);
                             window.location = response.redirectto;
                     
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
        checkout.show({amount: 1000});
    }
</script>
 {{-- khalti end --}}
@endsection