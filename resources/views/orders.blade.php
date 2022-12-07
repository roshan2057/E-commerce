@extends('navbar.navbar')
@section("content")
    <div class="container p-8 mx-auto mt-12 bg-white">
      <div class="w-full overflow-x-auto">
        <div class="my-2">
          <h3 class="text-xl font-bold tracking-wider">Orders</h3>
        </div>
        <table class="w-full shadow-inner">
          <thead>
            <tr class="bg-gray-100">
              <th class="px-6 py-3 font-bold whitespace-nowrap">Image</th>
              <th class="px-6 py-3 font-bold whitespace-nowrap">Name</th>
              <th class="px-6 py-3 font-bold whitespace-nowrap">Qty</th>
              
              <th class="px-6 py-3 font-bold whitespace-nowrap">Payment</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($order as $order)
                
          
            <tr>
              <td class="p-4 px-6 text-center whitespace-nowrap">
              <img class="p-8 rounded-t-lg" src="{{$order->image}}" width="150">
            </td>
              <td class="p-4 px-6 text-center whitespace-nowrap my-auto">
                {{$order->name}}
              </td>             
                    <td class="p-4 px-6 text-center whitespace-nowrap">{{$order->quantity}}</td>
                 
                
              </td>
              <td class="p-4 px-6 text-center whitespace-nowrap">Paid</td>
              <td class="p-4 px-6 text-center whitespace-nowrap">
               
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        
      </div>
    </div>
 @endsection
