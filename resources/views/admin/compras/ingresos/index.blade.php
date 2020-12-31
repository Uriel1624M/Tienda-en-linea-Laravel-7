@extends('admin.template')

@section('content')
	<div class="container text-center">

		<div class="page-header">
			<h1>
				<i class="fa fa-shopping-cart"></i>
				Ingresos
				<a href="{{route('ingresos.create')}}" class="btn btn-warning"> <i class="fa fa-plus-circle"></i> Ingreso</a>
			</h1>

		</div>
		<div class="row">
			<div class="col-md-4"></div>

			<div class="col-md-offset-4 col-xs-8 col-md-4">
				@include('admin.compras.ingresos.search')
			</div>
		</div>
		

			<div class="page">
				<div class="table-responsive">
					<table class=" table table-striped table-bordered table-hover">
						<thead>
							<th>#</th>
							<th>Fecha</th>
							<th>Proveedor</th>
							<th>Comprobante</th>
							<th>Impuesto</th>
							<th>Total</th>
							<th>Estado</th>
							<th>Detalles</th>
							<th>Cancelar</th>
						</thead>
						<tbody>
							
						@foreach ($ingresos as $item)
							<tr>
								<td>{{$item->id}}</td>
								<td>{{$item->fecha}}</td>
								<td>{{$item->nombre}}</td>
								<td>{{$item->tipo_comprobante." : ".$item->serie_comprobante." :".$item->num_comprobante}}</td>
								<td>{{$item->impuesto}}</td>
								<td>{{$item->total}}</td>
								<td>{{$item->estado}}</td>

								<td>
									<a href="{{route('ingresos.show',$item->id)}}" class="btn btn-primary">
										<i class="fa fa-pencil-square"></i> 
									</a>
								</td>
								<td> 
									
									{!! Form::open(['route'=>['ingresos.destroy',$item->id]])!!}
	                                   <input type="hidden" name="_method" value="DELETE">
	                                   
	                                   <button onclick="return confirm('Esta Seguro que desea Eliminar el ingreso de compra?')" class="btn btn-danger">
	                                  X
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
	                 {{ $ingresos->links('vendor.pagination.bootstrap-4') }}
	              </ul>
	        </nav>
			</div>
	</div>

@stop
