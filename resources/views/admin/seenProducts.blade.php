@extends('layout')

@section('title', 'Products')





@section('content')
<div class="container">

    <x-navbar page='other page'/>

    <h3 class="text-primary mt-5 mb-5">
        Name {{ Auth::user()->name }}
    </h3>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Product Description</th>
            <th scope="col">Product Image</th>
            <th scope="col">Product Quantity</th>
            <th>delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{$product->prodName}}</td>
                <td>{{$product->prodPrice}}</td>
                <td>{{$product->pordDesc}}</td>
                <td><img src="{{ Storage::url($product->prodImg) }}" alt="image" width="100px" height="100px"></td>
                <td>{{$product->prodQt}}</td>
                <td><a href="{{Route('delete', ['id' => $product->idProd])}}">icon</a></td>
            </tr>
        @endforeach
        </tbody>



    </table>


</div>
@endsection




