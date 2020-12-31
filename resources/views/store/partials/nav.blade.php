<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Store Laravel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarColor03">

      <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{route('home')}}">Inicio
              <span class="sr-only">(current)</span>
            </a>
          </li>
        
      </ul>

    <ul class="navbar-nav my-2 my-lg-0">
      
    <li class="nav-item dropdown show">


        {!!Form::open(['action'=>'StoreController@all','method'=>'GET','class'=>'form-inline my-2 my-lg-0','role'=>'search'])!!}
                
               {!!Form::text('busqueda',null,['class'=>'form-control mr-sm-2','placeholder'=>'Search...'])!!} 

                    <button  type="submit" class="btn btn-outline-success my-2 my-sm-0">
                      Buscar
                    </button>

        {!!Form::close()!!}



        <li class="nav-item">
            <a href="{{route('cart-show')}}" class="nav-link">
              <i class="fa fa-shopping-cart">
                @if(\Session::has('cart')!=null)
                {{count(\Session::get('cart'))}}
                @endif
              </i>
            
            </a>
        </li>
       
       <li class="nav-item">
            <a href="#" class="nav-link">
              Contacto
            </a>
       </li>

        @guest
           <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Iniciar Sesion</a>
          </li>
        
        <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Registrar</a></li>
        
        @else
            <li class="nav-item dropdown show">

              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                   <img src="{{Auth::user()->url_imagen}}" alt="" width="25px" height="25px"> {{ Auth::user()->name ." ".Auth::user()->last_name}}
              </a>
      
              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute;will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">

                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();"> 
                      Cerrar Sesion 
                  </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         {{ csrf_field() }}
                    </form>

               </div>

             </li>
        @endguest
      </li>
    </ul>    
  </div>
</nav>
