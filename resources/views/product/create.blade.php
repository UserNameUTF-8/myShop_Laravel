@extends('layout')


@section('title', 'Add Product')



@section('content')

<div class="container">

<x-navbar page='create'/>


<div class="row justify-content-center align-items-center" style="height: 80vh">

<div class="col-6" style="height: 70%">


<form action="{{ route('prodc') }}" method="POST" enctype="multipart/form-data">
    


@csrf
<div class="mb-3">
    <label for="nameproduct" class="form-label">Product  name</label>
    <input type="text" class="form-control" id="nameproduct" name="prodName" value="{{ old('prodName') }}">
    @error('prodName')
      <small class="text-danger"> {{ $message }} </small>
    @enderror
  </div>
  
  
  
<div class="mb-3">
  <label for="bio" class="form-label">Description</label>
  <textarea class="form-control" id="bio" rows="3" name="pordDesc"> {{ old('pordDesc')  }}</textarea>
  @error('pordDesc')
        <small class="text-danger"> {{ $message }} </small>
  @enderror
</div>
  

<div class="mb-3">
  <input class="form-control" type="file" id="formFile" name="photo" accept="image/jpg, image/png, image/svg">
  @error('photo')
    <small> {{ $message }} </small>
  @enderror
</div>




<div class="row mb-3">
  <div class="col-4">
    <input type="number" step='0.01' class="form-control" placeholder="price" aria-label="First name" name="prodPrice" value="{{ old('prodPrice') }}">
    @error('prodPrice')
      <small class="text-danger"> {{ $message }} </small>
    @enderror
  
  </div>

  <div class="col-4">
    <input type="number" class="form-control" placeholder="quentity" aria-label="Last name" name="prodQt" value="{{ old('prodQt') }}">
    @error('prodQt')
      <small class="text-danger"> {{ $message }} </small>
    @enderror
  
  </div>
  <div class="col-4">

    <select class="form-select" aria-label="Default select example" name="product_catid">
      @foreach ( $cats as $cat )
        <option value="{{ $cat->idcat }}"> {{ $cat->name }}  </option>
      @endforeach
    
    </select>

  </div>
</div>
    
  <button type="submit" class="btn btn-primary" name='submit' value="submit">Submit</button>
</form>


</div>




      
    </div>
</div>


@endsection



