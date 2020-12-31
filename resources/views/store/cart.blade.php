@extends('store.template')
@section('content')
<br>
	<div class="container text-center">
		<div class="page-header">
			<h1><i class="fa fa-shopping-cart"> Carrito de compras</i></h1>
		</div>
		<div class="table-cart">
			@if(count($cart))
				<p>
					<a  href="{{route('cart-trash')}}" class="btn btn-danger">
						Vaciar Carrito <i class="fa fa-trash fa-2x"></i>
					</a>
				</p>
			<div class="table-responsive">
				<table class="table table-stripped table-hover table-bordered">
					<thead>
						<tr>
							<th>Nombre </th>
							<th>Marca</th>
							<th>Imagen</th>
							<th>Talla</th>

							<th>Precio</th>
							<th>Cantidad</th>
							<th>Sub Total</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cart as $item)
						<tr>
							<td>{{$item->nombre}}</td>
							<td>{{$item->marca->marca}}</td>
							<td> <img src="{{ asset("storage/$item->url_imagen" )}}"> </td>
							<td>{{$item->talla}}</td>
							<td> $ {{$item->precio}}</td>

							<td>
								<input 
								type="number"
								min="1"
								max="100"
								value="{{$item->quantity}}" 
								id="articulo_{{$item->id}}">

								<a href="#" 
								   class="btn btn-warning btn-update-item"
								   data-href="{{route('cart-update',[$item->id,''])}}"
								   data-id="{{$item->id}}"
								   >
									<i class="fa fa-refresh"></i>
								</a>
							</td>
							


							<td> $ {{$item->quantity*$item->precio}}</td>
							<td>
								<a href="{{route('cart-delete',$item->id)}}" class="btn btn-danger">
									<i class="fa fa-remove"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<h2>
					<span class="btn btn-success">
						Sub Total : ${{$total}}
					</span>
				</h2>
			</div>
			@else
			<h3> Sin productos en tu compra</h3>
			@endif
			<hr>
				<p>
					<a href="{{route('home')}}" class="btn btn-success">
						Seguir comprando
						<i class="fa fa-chevron-circle-left "></i>
					</a>

					<a href="{{route('order-detail')}}" class="btn btn-danger">
						Continuar
						<i class="fa fa-chevron-circle-right "></i>
					</a>
				</p>
				
		</div>
	</div>
@stop