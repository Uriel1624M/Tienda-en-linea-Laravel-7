@extends('admin.template')

@section('content')

<div class="container">
		<div class="page-header">
			<h1>
			<i class="fa fa-shopping-cart"></i>
			Ingresos <small>[Detalles de Ingreso]</small>
			</h1>
		</div>

		<div class="row">
			<div class="col-md-12 offset-md-0">
				@if(count($errors)>0)
				@include('admin.partials.error')
				@endif
				<div class="page">

						<div class="form-group">
							<div class="row">
								<div class="col-md-6">

									{!! Form::label('id_proveedor', 'Proveedor :', array('class' => 'subrayado')) !!} 
									<p> {{$ingreso->nombre}}</p>
									
								</div>
								<div class="col-md-6">

									{!! Form::label('estado', 'Estado :', array('class' => 'subrayado')) !!} 
									<p> {{$ingreso->estado}}</p>
									
								</div>
							</div>
								 
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">

									{!! Form::label('tipo_comprobante', 'Tipo de Comprobante :', array('class' => 'subrayado')) !!}

				                	<p>{{$ingreso->tipo_comprobante}}</p>
									
									
								</div>
								<div class="col-md-4">
								{!! 
							   			Form::label('serie_comprobante', 'Serie de Comprobante:', array('class' => 'negrita')) 
							   		!!}  
							   		<p>{{$ingreso->serie_comprobante}}</p>
									
							    </div>

								
								<div class="col-md-4">
									{!!
									 		Form::label('num_comprobante', 'Numero Comprobante', array('class' => 'btn-block'))
									 !!}
									  
									  <p>{{$ingreso->num_comprobante}}</p>
									
								</div>

								
							</div>
													
						</div>

						<fieldset class="border p-2">

							<div class="form-group">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="detalles">
										<thead style="background-color: #A9D0F5">
											<tr>
												<th>#</th>
												<th>Articulo</th>
												<th>Talla</th>
												<th>Cantidad</th>
												<th>Precio Compra</th>
												<th>Precio venta</th>
												<th>SubTotal</th>

											</tr>
										</thead>
										<tfoot>
												<th>Total :</th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th> <h4 id="total"> $ {{$ingreso->total}}</h4> </th>


										   </tfoot>

										<tbody>
											@foreach($detalles  as $detalle)
											<tr>
												<td>#</td>
												<td>{{$detalle->nombre}}</td>
												<td>{{$detalle->idtalla}}</td>
												<td>{{$detalle->cantidad}}</td>
												<td>$ {{$detalle->precio_compra}}</td>
												<td>$ {{$detalle->precio_venta}}</td>
												<td>$ {{$detalle->precio_compra * $detalle->cantidad}}</td>
											</tr>

											@endforeach

										</tbody>
									</table>
								</div>
							</div>
						</fieldset>
						<hr>
						<div class="form-group">

							<a  href="{{route('ingresos.index')}}" class="btn btn-success"> Volver</a>
						</div>

				</div>
			</div>
		</div>
	</div>

@stop
