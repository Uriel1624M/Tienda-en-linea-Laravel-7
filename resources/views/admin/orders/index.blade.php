@extends('admin.template')

@section('content')
	

	<div class="container text-center">

		<div class="page-header">
			<h1>
				<i class="fa fa-cc-paypal"></i>
				Pedidos
	
			</h1>

		</div>



		<div class="page">
					@include('admin.orders.filtro')
			<hr>
			<div class="table-responsive">
			<table class="table table-striped table-bordered-table-hover">
				<thead>
					<tr>
						<th>#</th>
					    <th>Fecha</th>
						<th>Cliente</th>
						<th>Subtotal</th>
						<th>Envio</th>

						<th>Total</th>
						<th>Estado</th>

						<th>Ver Detalle</th>
						<th>Eliminar</th>

					</tr>
				</thead>
				<tbody>
					@foreach ($orders as $item)
						<tr>
							<td>{{$item->id}}</td>
							<td>{{$item->fecha}}</td>
							<td>{{$item->users->name." ".$item->users->last_name }}</td>
							<td>$ {{ $item->subtotal}}</td>
							<td>$ {{$item->shipping}}</td>
							
							<td>$ {{$item->subtotal+$item->shipping}}</td>
							<td>
								<div class="d-flex mx-1">

									<select  id="estado_{{$item->id}}" class="form-control">
										<option value="{{$item->estado}}">{{$item->estado}}</option>
										<option value="recibido"> Recibido</option>
										<option value="transferido"> Transferido</option>
										<option value="enviado"> Enviado</option>
									</select>

					                	
									   <a href="#" 
									   	class="btn btn-warning btn-update-estado"
									   data-href="{{route('order-estado',[$item->id,''])}}"
									   data-id="{{$item->id}}"
										   >
											<i class="fa fa-refresh"></i>
										</a>
									</div>
							</td>

							<td>
								<a href="#"
								   class="btn btn-primary btn-detalle-pedido"
								   data-id="{{$item->id}}"
								   data-path="{{route('order-getItems')}}"
								   data-toggle="modal"
								   data-target="#myModal"
								   data-token="{{csrf_token()}}">
									<i class="fa fa-external-link"></i>
								</a>
							</td>
							<td> 
								
								{!! Form::open(['route'=>['orders.destroy',$item->id]])!!}
                                   <input type="hidden" name="_method" value="DELETE">
                                   
                                   <button onclick="return confirm('Esta Seguro que desea Eliminar el pedido?')" class="btn btn-danger">
                                    <i class=" fa fa-trash"></i>
                                   </button>
                                  {!!Form::close()!!}

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>	
			<nav>
	             <ul class="pagination justify-contend-end">
	                 {{ $orders->links('vendor.pagination.bootstrap-4') }}
	              </ul>
	        </nav>		
		</div>
	</div>
	@include('admin.partials.modal-detalle-pedido')

@stop
