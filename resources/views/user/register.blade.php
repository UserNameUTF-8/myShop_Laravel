@extends('layout')

@section('title', 'Register')


@section('content')



{{-- action todo --}}


<div class="container">
  <x-navbar page='home'/>

<div class="row justify-content-center align-items-center " style="height:70vh">


<div class="col-6" style="height:70%">



<h1 class="mb-5 mt-5">Sign <span class="text-decoration-underline">In</span></h1>


<form action="{{ route('userReg') }}" method="POST">

  @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mail" value="{{ old('mail') }}">
    @error('mail')
        <small style="color: red"> {{ $message }}</small>
    @enderror
  </div>



    <div class="mb-3">
    <label for="username" class="form-label">User name</label>
    <input type="text"  class="form-control" id="username" aria-describedby="emailHelp" name="name" value="{{ old('name') }}">
    @error('name')
        <small style="color: red"> {{ $message }}</small>
    @enderror
  </div>


  <div class="mb-3">
      <label for="number" class="form-label">Number</label>
      <input type="text" class="form-control" id="number" aria-describedby="emailHelp" name="number" value="{{ old('number') }}">
     @error('number')
        <small style="color: red"> {{ $message }}</small>
     @enderror
    </div>




  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    @error('password')
        <small style="color: red"> {{ $message }}</small>
    @enderror
  </div>
  
  

  

  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
  <input type="reset" value="reset" class="btn text-primary"> 


</form>

</div>
</div>


</div>

@endsection

