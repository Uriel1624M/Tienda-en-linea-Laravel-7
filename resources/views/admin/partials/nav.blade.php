<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Store Laravel</a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor03">

      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{route('home-admin')}}"> <i class="fa fa-dashboard"></i> Dashobard
            <span class="sr-only">(current)</span>
          </a>
        </li>
          
       </ul>

    <ul class="navbar-nav my-2 my-lg-0">
      
        <li class="nav-item dropdown show">

           

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-shopping-cart"></i>
                    Articulos
               </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                   <a class="dropdown-item" href="{{route('categoria.index')}}">
                    <i class="fa fa-list-alt"></i>
                     Categorias
                 </a>
                 <a class="dropdown-item" href="{{route('marcas.index')}}">
                  <i class="fa fa-id-card-o" aria-hidden="true"></i>


                   Marcas
                 </a>
                 <a class="dropdown-item" href="{{route('tallas.index')}}">
                  <i class="fa fa-male" aria-hidden="true"></i>
                  Tallas
                 </a>
                 <a class="dropdown-item" href="{{route('articulos.index')}}">
                  <i class="fa fa-shopping-cart"></i>
                  Articulos
                  </a>
                  

               </div>
             </li>
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Almacen
               </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                   <a class="dropdown-item" href="{{route('ingresos.index')}}">
                       <i class="fa fa-money"></i>
                    Compras
                   </a>
                 <a class="dropdown-item" href="{{route('orders.index')}}">
                    <i class="fa fa-cc-paypal"></i>
                  Pedidos
                  </a>
                  <a class="dropdown-item" href="{{route('articulotalla.index')}}">
                    <i class="fa fa-shopping-cart"></i>
                      Stock
                  </a>
                  
                  

               </div>





             </li>
              <li class="nav-item">
                  <a href="{{route('users.index')}}" class="nav-link">
                    <i class="fa fa-users"></i>
                    Usuarios
                  </a>
             </li>
             <li class="nav-item">
                  <a href="{{route('proveedor.index')}}" class="nav-link">
                    <i class="fa fa-users"></i>
                    Proveedores
                  </a>
             </li>


            @guest
               <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Iniciar Sesion</a>
              </li>
            
               <li class="nav-item"><a class="nav-link" href="">Registrar</a></li>
          
            @else
                <li class="nav-item dropdown show">

                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                           <img src="{{Auth::user()->url_imagen}}" alt="" width="25px" height="25px"> {{ Auth::user()->name." ".Auth::user()->last_name}}
                      </a>
          
                      <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">

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
        </ul>    
   </div>
</nav>



