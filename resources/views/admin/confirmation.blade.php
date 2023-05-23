@extends('layout')




@section('title', 'delete confirmation')

<div class="container">



@section('content')
    <x-navbar page='confirmation' />



<h3 class="mt-5 mb-5">Name {{ Auth::user()->name }}</h3>
<hr>

<h3>sudo</h3>

<div class="row ">



    <p class="load col-6">
        as administrator are you sure you wenna <span style="color: red"> delete </span> user {{ $user->name }}
    </p>


    <div class="col-6">
        <a href="{{ route('deleteUser', ['id' => $user->id]) }}" class="btn btn-primary">sure</a>
        <a href="{{ route('db') }}" class="btn btn-primary">exit</a>
    </div>


</div>


</div>





@endsection

