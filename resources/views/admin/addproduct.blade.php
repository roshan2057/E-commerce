@extends('admin.master.main')
@section('content')
<div class="flex flex-col justify-center items-center p-20">



<form method="POST" action="{{route('category.add')}}" class="w-full max-w-lg">
  <div class="flex flex-wrap -mx-3 mb-6">
  @csrf
  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Category</label>
  <input type="text" name="category" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
  <input type="submit" value="Add" class="p-3 px-6 pt-2 text-white bg-black rounded-full baseline">
  </div>
</form>
<br>



<h1>Add New Product</h1>
<form class="w-full max-w-lg" action="{{route('product.store')}}" method="POST">
    @csrf
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
          Product Name
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text"  name="name" placeholder="Product Name">
       @error('name')
       {{$message}}
      
           
       @enderror
      </div>

      <div class="w-full md:w-1/2 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
          Product Category
        </label>
       
<select name="category" id="cars" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
<option>Please Select</option>
  @foreach($category as $cat)
  <option value="{{$cat->category}}">{{$cat->category}}</option>
  @endforeach
</select>
      </div>



      <div class="w-full md:w-1/2 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
          Product Price
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" name="price" placeholder="1500">
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
          Product Image url
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text" name="image" placeholder="http://image.jpg">
        
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-2">
      
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
              Product Description
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="message" name="description" placeholder="Product descrtiption">
           
          </div>
        </div>
          <input class="p-3 px-6 pt-2 text-white bg-black rounded-full baseline" type="submit" value="Insert">
                
   
</div>
  </form>
  @endsection