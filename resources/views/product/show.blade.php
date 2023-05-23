@extends('layout')



@section('title', 'Product-Show')





@section('content')


<div class="container">

    <x-navbar page='product'/>



            
            {{-- user section --}}
            
            
            {{-- end user section --}}
                        

        <section class="product">

            <h1 class="my-5 display-6 text-primary">
                Product View
            </h1>


             {{-- card  --}}
            <div class="div" style="width: 70%; margin: auto">



            <div class="card mb-3" style="">
            <div class="row g-0">
                <div class="col-md-4">
                <img src="{{ Storage::url($product->prodImg )}}" class="img-fluid rounded-start " alt="...">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title display-5">{{ $product->prodName }}</h5>
                    <p class="card-text lead" style="max-hight: 60%">{{ $product->pordDesc }}</p>
                    <p class="card-text lead ">{{ $product->prodPrice }}dt</p>
                    
                    
                    <div class="d-flex justify-content-end">
                        <div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                            Manager
                        </button>
                        <ul class="dropdown-menu">
                            
                            <li class="dropdown-item"><b>Name</b></li>
                            <li class="dropdown-item"> {{ $user->name }} </li>
                            <li><hr class="dropdown-divider"></li>
                            <li class="dropdown-item"><b>Phone</b></li>
                            <li class="dropdown-item">{{ $user->tel_num }}</li>
                        </ul>
                        </div>

                        <a href="mailto:{{ $user->mail }}" class="btn btn-outline-primary mx-2">Contact</a> 
                    </div>


                

                </div>
                </div>
            </div>
            </div>
                       
            </div>





            {{-- end card  --}}



 </section>


        <div class="divider">
            <hr>
        </div>

            {{-- related product 

        @if(count($related_products) > 1)

        <section class="related_products">

            <h1 class="my-5 display-6 text-primary">
                Related Product
            </h1>
        
                <div class="row row-cols-sm-1 row-cols-md-3 row-cols-xl-4 gy-2">
                        @foreach ($related_products as $prod )
                        @if($prod->idProd != $product->idProd)
                        <div>              
                            <x-card :item = $prod />
                        </div>
                        @endif
                        @endforeach
                </div>            

        </section>
        @endif --}}




            {{-- manager product --}}
{{-- 
        @if(count($manage_products) > 1)


    <div class="divider">
            <hr>
        </div>

        <section class="related_products">

            <h1 class="my-5 display-6 text-primary">
                Manager Product ({{ $user->name }})
            </h1>
        
                <div class="row row-cols-sm-1 row-cols-md-3 row-cols-xl-4 gy-2">
                        @foreach ($manage_products as $item )
                        @if($item->idProd != $product->item)
                        <div>                            
                              <x-card $:item /> 
                        </div>
                        @endif
                        @endforeach
                </div>            

        </section>
        @endif --}}



    @if (count($related_products) > 1)
        
 <section>


            <h1 class="my-5 display-6 text-primary">
                Related Product
            </h1>
        
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-xl-4 gy-2">
            @foreach ($related_products as $item )
                @if($item->idProd != $product->idProd)
                <div>
                    <x-card :$item />
                </div>
                @endif
            @endforeach
        </div>
        </section>
    @endif



    
@if (count($manage_products) > 1)
    <div class="divider">
            <hr>
        </div>
    
        <h1 class="my-5 display-6 text-primary">
            Manager Product <span style="color:black">{{ $user->name }}</span>
        </h1>
        <div class="row row-cols-sm-1 row-cols-md-3 row-cols-xl-4 gy-2">
        @foreach ($manage_products as $item )
            @if($item->idProd != $product->idProd)
            <div>
                <x-card :$item />
            </div>
            @endif
                
        @endforeach
        </div>
@endif


</div>




 <footer class="mt-5 p-5" style="background-color:#eee" >
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="lead text-center">
                        myShop &copy; 2023
                        <span>
                            made with love by <a href="mailto:essid101010@gmail.com">Amine Essid &#10084;</a>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </footer>




@endsection




