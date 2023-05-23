@extends('layout')
@section('title', 'myShop - homepage')




@section('head')

<link rel="stylesheet" href="{{ asset('/asset/css/home.css') }}">

@endsection



@section('content')


<div class="container">
    <x-navbar page='home' search='ok' />
    

    <section class="landing_page">
        <div class="textual_content ">

        <h1 class="text-primary display-3">
            myShop
        </h1>
            <p class="lead">
                myshop is a website that allows you to buy and sell products online
                your first step for BTB 
            </p>
        </div>

        <div class="image_container ">
            <img src="{{ asset('asset/image/homePage/undraw_web_shopping_re_owap.svg') }}" alt="landing_page_image" class="img">
        </div>


    </section>



    {{-- tooltops --}}

    <nav class="row justify-content-center">
        
        
        <div class="lead justify-self-start col-12 " >Toobar</div>

    
    
        
        <div class="col-md-10 row mt-2 ">
        <select class="form-select col" id="mySelect" aria-label="Default select example">
            <option selected>all</option>
            @foreach ($all_cats as $cat )
            <option value="{{ $cat->idcat }}">{{ $cat->name }}</option>
            @endforeach
        </select>


              <div  class="col align-self-center">      
           <button class="btn btn-primary col mx-2" id="btnSearch"   data-bs-toggle="modal" data-bs-target="#exampleModal"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>    
            </button>
        </div>

        </div>


    </nav>


    {{-- end tooltops --}}
    

@foreach ($cats as $cat)

    <div class="section_cont">
    <hr>
    <div class="header">
    <h1 class="text-capitalize display-6 text-primary"> {{ $cat->name }} </h1>
    <p class="lead text-capitalize"> {{ $cat->bio }}</p>
    </div>

<div class="row g-5 align-items-strutch">
    @foreach ($prod_cats as $catid => $prod )
        @if($catid == $cat->idcat )
                @foreach ($prod as $item)
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 hi">
                     <x-card :$item/>
                </div>    
                @endforeach

        @endif
    @endforeach
 
</div>
</div>

@endforeach





{{-- this is model search --}}


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Search</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <input type="text" class="form-control" id="myInputSearch" placeholder="product search">
          </div>
        </form>
      <ul id="searchRes" class="list-group"></ul>

    </div>



    </div>
  </div>
</div>



 {{-- search script --}}
        <script>
            let myInputSearch = document.getElementById('myInputSearch');
            let searchRes = document.getElementById('searchRes');

    


            myInputSearch.addEventListener('keyup', function(e){
                searchRes.innerHTML = "";
                if(e.keyCode === 13){
                    btnSearch.click();
                }else if(e.target.value.length > 0){
                    console.log(e.target.value);
                    xmlhttp = new XMLHttpRequest();
                    xmlhttp.onload = function(){
                        const myJson = JSON.parse(this.responseText);

                        
                        for(let i = 0; i < Math.min(myJson.length, 5); i++){
                            console.log(myJson[i].prodName);
                            myLink = document.createElement('a');
                            myLink.setAttribute('href', '{{ url('/product') }}/' + myJson[i].idProd);
                            myLink.innerHTML = myJson[i].prodName;
                            myLink.classList.add('text-decoration-none');
                            myli = document.createElement('li');
                            myli.classList.add('list-group-item');
                            myimg = document.createElement('img');

                            // product url http://localhost:8000/storage/username_1/fM3j4h8q1TBC3aMrZZApCRRRTiYIns1VcCFTGM28.png
                            // ET
                            //             http://localhost:8000/storage/public/username_1/fM3j4h8q1TBC3aMrZZApCRRRTiYIns1VcCFTGM28.png
                            // our prod url in page

                            // correction of link
                            ourlink = myJson[i].prodImg.substring(7);

                            myimg.setAttribute('src', '{{ Storage::url('') }}' + ourlink);
                            myimg.setAttribute('width', '50px');
                            myimg.setAttribute('height', '50px');
                            myli.appendChild(myimg);
                            myLink.classList.add('mx-2');
                            myli.appendChild(myLink);                        
                            searchRes.appendChild(myli);
                        
                        }


                        
                    }

                    let url = "{{ route('search') }}" + "?name=" + e.target.value;
                    xmlhttp.open("GET", url);
                    xmlhttp.send();

                }
            })



        </script>


 {{-- end search script --}}


{{-- end model search --}}





<script>

    let mySelect = document.getElementById('mySelect');

    const url = new URL(window.location.href);

    mySelect.addEventListener('change', function(e){
    
        url.searchParams.set('cat', e.target.value);
            location.href = url;
        })

</script>



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

