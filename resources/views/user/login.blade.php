@extends('layout')

@section('title', 'login')

@section('content')








<div class="container">


<x-navbar page='login'/>


  <div class="row justify-content-center align-items-center" style="height:70vh">



<div class="col-6" style="height: 60%" >




<h1  class="mb-5 mt-5" >Log <small style="text-decoration: underline">in</small></h1>







<form action="{{ route('dashboard') }}" method="POST">
    
@error('email')
  <small class="text-danger"> {{ $message }} </small>
@enderror

  
  {{ csrf_field() }}
    <div class="mb-3">



    
    <label for="exampleInputEmail1" class="form-label">Email address</label>



    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mail">
  


</div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>


    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  


</div>

<div class="mb-3">
  <a href="#" class="text-priamry text-decoration-none">forget password</a>


</div>



  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>

</div>


</div>

@endsection


