@extends('admin.template')

@section('content')
	

	<div class="container text-center">
		<div class="page-header">
			<h1>
				<i class="fa fa-shopping-cart"></i>
				Proveedores
				<a href="{{route('proveedor.create')}}" class="btn btn-warning"> <i class="fa fa-plus-circle"></i> Proveedor</a>
			</h1>

		</div>
		<div class="row">
			<div class="col-md-4"></div>

			<div class="col-md-offset-4 col-xs-8 col-md-4">
				
			</div>
		</div>
		

		<div class="page">
			<div class="table-responsive">
			<table class="table table-striped table-bordered-table-hover">
				<thead>
					<tr>
						<th>NOMBRE</th>
						<th>EMAIL</th>
						<th>TELEFONO</th>
						<th>DIRECCION</th>
						<th>ACTUALIZAR</th>
						<th>ELIMINAR</th>

					</tr>
				</thead>
				<tbody>
					@foreach ($proveedores as $item)
						<tr>

							<td>{{$item->nombre}}</td>
							<td>{{$item->email}}</td>
							<td>{{$item->telefono}}</td>
							<td>{{$item->direccion}}</td>
							<td>
								<a href="{{route('proveedor.edit',$item->id)}}" class="btn btn-primary">
									<i class="fa fa-pencil-square"></i>
								</a>
							</td>
							<td> 
								
								{!! Form::open(['route'=>['proveedor.destroy',$item->id]])!!}
                                   <input type="hidden" name="_method" value="DELETE">
                                   
                                   <button onclick="return confirm('Esta Seguro que desea Eliminar el proveedor?')" class="btn btn-danger">
                                    <i class=" fa fa-trash"></i>
                                   </button>
                                  {!!Form::close()!!}

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>		
		</div>
	</div>
@stop
