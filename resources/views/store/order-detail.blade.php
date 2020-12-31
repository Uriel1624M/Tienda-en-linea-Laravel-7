@extends('store.template')
@section('content')
<br>
	<div class="container text-center">
		<div class="page-header">
			<h1><i class="fa fa-shopping-cart"></i> Detalle de pedido</h1>
		</div>
		<div class="table-cart">
			<div class="table-responsive">
				<h3>Datos de usuarios</h3><br>
				<table class="table table-striped table-hover table-bordered">
					<tr><td>Nombre</td><td>{{Auth::user()->name}}</td></tr>
					<tr><td>Apellido :</td><td>{{Auth::user()->last_name}}</td></tr>
					<tr><td>Email :</td><td>{{Auth::user()->email}}</td></tr>
					<tr><td>Dirreccion :</td><td>{{Auth::user()->address}}</td></tr>

				</table>

			</div>
			<div class="table-responsive">
				<h3>Datos del pedido</h3><br>
				<table class="table table-striped table-hover table-bordered">
					<tr>
						<th>Nombre</th>
					    <th>Marca</th>
					    <th>Talla</th>
					    <th>Precio</th>
					    <th>Cantidad</th>
					    <th>Subtotal</th>

					</tr>
					@foreach($cart as $item)
						<tr>
							<td>{{$item->nombre}}</td>
							<td>{{$item->marca->marca}}</td>
							<td>{{$item->talla}}</td>
							<td>$ {{$item->precio}}</td>
							<td>{{$item->quantity}}</td>
							<td>$ {{$item->quantity*$item->precio}}</td>
						</tr>
					@endforeach
					<tr>
					<td>Costo de envío</td>
					<td></td>
                    <td></td>
                    <td>$ {{ $envio }}</td>
                    <td>1</td>
                    <td>$ {{ $envio }}</td>
                </tr>

				</table>
				<hr>

			</div>

			<div class="row">
				<div class="col-md-6 offset-md-6">
					<!---->
			
				<div class="table-responsive ">

					     

					<table class="table table-striped table-hover table-bordered w-2/5">
						<tr>

						<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Sub Total</td>
										<td>$ {{number_format($subtotal, 2)}}</td>
									</tr>
									<tr>
										<td>Impuestos (16%):</td>
										<td>$ {{number_format($taxes, 2)}}</td>
									</tr>

									<tr>
										<td>Total</td>
										<td><span>$ {{number_format($total, 2)}}</span></td>
									</tr>
								</table>
							</td>
 
                        
					</table>
					<hr>
					<p>
					<a href="{{route('cart-show')}}" class="btn btn-info"> Regresar</a>

					<a href="{{route('payment')}}" class="btn btn-warning"> Pagar Con 
						<i class="fa fa-cc-paypal fa-2x" aria-hidden="true"></i>

					</a>
				</p>

				</div>
				<!---->
				</div>
			</div>
		</div>
	</div>
@stop