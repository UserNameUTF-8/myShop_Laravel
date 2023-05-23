@extends('layout')

@section("title", 'Dashboard')

@section('content')

<div class="container">


<x-navbar page='dashbord' search='ok'/>


<div class="mt-5">

    <div class="d-flex flex-row  justify-content-between align-items-center">
       <h2 class="text-primary"> {{Auth::user()->name}} </h2>
        <a href="{{ route('productShowCreate') }}"  class="btn btn-outline-primary"> New Product</a>
    </div>
</div>
<hr>






<table class="table">

    <tr class="text-capitalize">
        <th> product name </td>
        <th> product description </td>
        <th> product image </td>
        <th class="text-center"> product price </td>
        <th class="text-center"> product quentity </td>
        <th> update </th>
        <th> delete </th>
    </tr>

        @foreach ( $products as $product )
            <tr>
                <td >  {{ $product->prodName }} </td>
                <td>  {{ $product->pordDesc }} </td>
                <td class="ratio ratio-4x3 " style="width: 130px">  <img src="{{ Storage::url($product->prodImg) }}" class="rounded" alt="product image"></td>
                <td class="text-center">  {{ $product->prodPrice }} </td>
                
                <td class="text-center">  {{ $product->prodQt }} </td>
                <td> <a class="btn btn-primary" href="{{ route('product', ['id' => $product->idProd])}}">update</a>
                <td>  <a href=" {{ route('delete', ['id' => $product->idProd])}}" class="btn" > 
                
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg>
                </a></td>
            </tr>
        @endforeach
    
</table>


@endsection