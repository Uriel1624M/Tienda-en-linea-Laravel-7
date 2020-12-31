@extends('store.template')
@section('content')
<br>
	<div class="container-fluid text-center">
		<div class="page-header">
			<h1> <i class="fa fa-shopping-cart"></i> Detalle del Articulo</h1>
		</div>

		<hr>
		<div class="row">

			<div class="col-md-6">
				<div class="product-block">
					
			      <img class="img1" src="{{ asset("storage/$articulo->url_imagen" )}}" width="300">
			      <img name="grande" class="img2" src="{{ asset("storage/$articulo->url_imagen" )}}" width="600">
			  
		 		</div>

			</div>

			<div class="col-md-6 ">
				<div class="product-block">

				{!! Form::open(['route'=>'cart-add', 'method'=>'GET', 'role' => 'form'])!!}

				  <input type="hidden" name="id_articulo" value="{{$articulo->id}}">

					<h2>{{$articulo->nombre}}</h2>

					<p>{{$articulo->extract}}</p>

					<!---->

					<div class="panel-group" id="accordion">
					    <div class="panel panel-default">
					      <div class="panel-heading">
					        <h4 class="panel-title">
					          <a  data-toggle="collapse" data-parent="#accordion" href="#collapse1">Descripcion +</a>
					        </h4>
					      </div>
					      <div id="collapse1" class="panel-collapse collapse in">
						        <div class="panel-body">
						         {{$articulo->descripcion}}
						        	
						       </div>
					      </div>
					    </div>
				    </div> 


					<div class="panel-group" id="accordion">
					    <div class="panel panel-default">
					      <div class="panel-heading">
					        <h4 class="panel-title">
					          <a  data-toggle="collapse" data-parent="#accordion" href="#collapse2">Especificaciones +</a>
					        </h4>
					      </div>
					      <div id="collapse2" class="panel-collapse collapse in">
						        <div class="panel-body">
						         {{$articulo->especificaciones}}
						        	
						       </div>
					      </div>
					    </div>
				    </div> 


					<p>
						<h4> Talla :
						{!!Form::select('id_talla', $detail_articulo, null, array('class'=>''))!!}
						</h4>

					</p>
					<p>
						<h4> Cantidad : <input type="number" name="quantityrqst" min="1" max="100" value="1">
						</h4>
					</p>


					<h2> Precio: ${{$articulo->precio}}</h2>

						{{ Form::button('Agregar al carrito <i class="fa fa-cart-plus"></i>',['type' => 'submit', 'class' => 'btn btn-warning'] )  }}

						<hr>

				</div>

				{!! Form::close() !!}
				
			</div>
		</div>
		<hr>		
		<p> <a class="btn btn-primary" href="{{ URL::previous() }}"> Volver

				<i class="fa fa-chevron-circle-left"></i>

			</a> 
	   </p>
	</div>
	
        <script type="text/javascript">
        	document.onmousemove=ver;

        	function ver(e) {

        		var x,y,x1,x2,y1,y2;
        		fact=600/300;
        		opp=100;
        		if (e==null) e=window.event;
        		x=e.clientX;
        		y=e.clientY;

        		x1=-opp+(x)*fact;
        		y1=-opp+(y)*fact;
        		x2=+opp+(x)*fact;
        		y2=+opp+(y)*fact;

        		document.images.grande.style.display="inline";
        		document.images.grande.style.left=(x)*(1-fact);
        		document.images.grande.style.top=(y)*(1-fact);
        		document.images.grande.style.clip="rect("+y1+"px,"+x2+"px,"+y2+"px,"+x1+"px)";

        	}
        	
        </script>


       
@stop
