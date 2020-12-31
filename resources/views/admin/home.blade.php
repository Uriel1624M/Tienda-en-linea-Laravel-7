 @extends('admin.template')

@section('content')
<div class="container-fluid text-center">
	<div class="page-header">
		<h1> <i class="fa fa-rocket"></i> My Laravel Store Dashobard</h1>
	</div>
	<h2>Bienvenido(a) {{Auth::user()->name}} al panel de administracion</h2>
	<div class="row">
		
		<div class="col-md-4">
			<div class="panel">
				<i class="fa fa-shopping-cart icon-home"></i>
				<a href="{{route('articulos.index')}}" class="btn btn-warning btn-block btn-home-admin">
					Articulos
				</a>
			</div>
		</div>

		<div class="col-md-4">
				<div class="panel">
					<i class="fa fa-money icon-home"></i>
					<a href="{{route('ingresos.index')}}" class="btn btn-warning btn-block btn-home-admin">
						Compras
					</a>
				</div>
		</div>	

		<div class="col-md-4">
				<div class="panel">
				<div class="form-group">
					<i class="fa fa-cc-paypal icon-home"></i>
					<button class="btn btn-danger">
						 <i class="fa fa-plus-circle"></i>
						<span class="tag tag tag-primary tag-pill float-xs-right mr-2""><h7>{{$orders}}</h7></span>
					</button> 	

					
					<a href="{{route('orders.index')}}" class="btn btn-warning btn-block btn-home-admin">
						Pedidos
						
					</a>
</div>
				</div>
			</div>




	</div>

	<div class="row">
			
			<div class="col-md-4">
				<div class="panel">
					<i class="fa fa-bar-chart icon-home"></i>
					<a href="{{route('estadisticas.index')}}" class="btn btn-warning btn-block btn-home-admin">
						GRaficas
					</a>
				</div>
			</div>


	</div>


	<br>
	
</div>	

@stop
