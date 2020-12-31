@extends('store.template')

@section('content')
<br>
<!-- Page Content -->
  <div class="container-fluid">

        @include('store.partials.slider')


    <div class="row">

    <!-- /.col-lg-3 -->
      <div class="col-lg-3 col-md-12">

	        <h1 class="my-4">Categorias</h1>
	       <li class="list-group-item">

		        @foreach ($categorias as $cat)
			        <a href="/?categoria={{ $cat->id }}" class="list-group-item list-group-item-action list-group-item-primary" role="tab">
			                     <span class="relative">{{ $cat->nombre }}</span>
			        </a>
			    @endforeach
		    </li>
      </div>
      <hr>
      <!-- /.col-lg-3 -->

      <!-- /.col-lg-9 -->

      <div class="col-lg-9">

      
        <div class="row">

        		@if($articulos->isNotEmpty())
        		@foreach($articulos as $item)
        		<div class="col-lg-4 col-md-12 mb-4">
			            <div class="card h-100 ">
			              <a href="#"><img class="card-img-top" src="{{ asset("storage/$item->url_imagen" )}}" alt=""></a>
			              <div class="card-body">
			                <h4 class="card-title">
			                  <a href="{{ route('articulo-detalle',$item->id) }}">{{$item->nombre}}</a>
			                </h4>
			                <h5>${{$item->precio}}</h5>
			                <p class="card-text">
			                	{{$item->extract}}
			                </p>
			              </div>
			              <div class="card-footer">
			                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
			              </div>
			            </div>
			    </div>
			    @endforeach
			         
          @else
                    <div class="card">
                    <div class="card-body">
                      <p> 
                        <strong>
                        <h2 class="panel-title">  
                          <center>!! No hay concidencias vuelve a intentarlo !!</center> 
                        </h2> 
                        <a  href="{{route('home')}}" class="btn btn-success">
                          <i class="fa fa-chevron-circle-left"></i>
                          Regresar

                        </a>
                      </strong>
                    </p>
                    </div>
                  </div>

         @endif

        </div>
        <!-- /.row -->
                <nav>
                   <ul class="pagination justify-contend-end">
                               {{ $articulos->links('vendor.pagination.bootstrap-4') }}
                    </ul>
              </nav>

      </div>
      <!-- /.col-lg-9 -->


    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

@stop

