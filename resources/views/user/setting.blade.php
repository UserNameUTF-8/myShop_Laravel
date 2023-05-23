@extends('layout')



@section('title', 'update')



@section('content')


<div class="container">
  <x-navbar page='dashbord'/>



<div class="row justify-content-center align-items-center" style="height: 70vh" >

  <div class="col-6" style="height:70%">


 
    <h2 class="mb-5 mt-5">Update {{ Auth::user()->name}} Profile</h2>




<form method="POST" action="{{  route('userupdate')  }}">

@csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled value="{{ Auth::user()->mail }}">
        <div id="emailHelp" class="form-text">mail con't be updatetable.</div>
     </div>
    

     
     <div class="mb-3">
         <label for="name" class="form-label">name</label>
         <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
     </div>



  <div class="mb-3">
        <label for="phone" class="form-label">number</label>
        <input type="text" class="form-control" id="phone" name="number" value="{{ Auth::user()->tel_num }}">
    </div>


  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>

  
  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>


</form>


</div>


   
  </div>



</div>


@endsection



