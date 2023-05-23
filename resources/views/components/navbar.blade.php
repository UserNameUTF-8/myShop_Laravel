
@props(['page', 'search' => 'No'])



<nav class="navbar navbar-expand-lg  rounded-5 shadow-sm sticky-top z-3 text-capitalize" style="font-size: 1.2rem; background-color:white;">
  <div class="container-fluid">
    <a class="navbar-brand text-primary fw-bold" href="{{ route('pagehome') }}">myShop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link @if($page == 'home') active @endif" aria-current="page" href="{{ route('pagehome') }}">Home</a>
        </li>

        @auth
          
        <li class="nav-item">
          <a class="nav-link @if($page == 'dashbord') active @endif " href="{{ route('db') }}">dashboard</a>
        </li>


         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('info')}}">profile</a></li>
            <li><a class="dropdown-item" href="{{ route('showsetting') }}">settings</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">log out</a></li>
          </ul>
        </li>

        @endauth


        @guest

         <li class="nav-item">
          <a class="nav-link" href="#">contact</a>
        </li>


        @if ($page == 'login')

        <li class="nav-item">
          <a class="nav-link text-primary" href="{{ route('regsiter' )}}">register</a>
        </li>

        @else
          
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login' )}}">log in</a>
        </li>
        
        @endif
  

        
        @endguest
        
        
        
      
      </ul>
  

    </div>
  </div>
</nav>