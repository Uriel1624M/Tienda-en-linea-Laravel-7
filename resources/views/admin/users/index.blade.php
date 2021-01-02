@extends('admin.template')

@section('content')
	

	<div class="container text-center">
		<div class="page-header">
			<h1>
				<i class="fa fa-users"></i>
				Usuarios
				<a href="{{route('users.create')}}" class="btn btn-warning"> <i class="fa fa-plus-circle"></i> Usuario</a>
			</h1>

		</div>

		<div class="page">
			<div class="table-responsive">
			<table class="table table-striped table-bordered-table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Correo</th>
						<th>Tipo</th>
						<th>Activo</th>
						<th>ACTUALIZAR</th>
						<th>ELIMINAR</th>

					</tr>
				</thead>
				<tbody>
					@foreach ($users as $item)
						<tr>
							<td>{{$item->name." ". $item->last_name}}</td>
							<td>{{$item->email}}</td>
							<td>{{$item->type}}</td>
							<td>{{$item->active==1 ? "SI" : "NO"}}</td>
							<td>
								<a href="{{route('users.edit',$item->id)}}" class="btn btn-primary">
									<i class="fa fa-pencil-square"></i>
								</a>
							</td>
							<td> 
								
								{!! Form::open(['route'=>['users.destroy',$item->id]])!!}
                                   <input type="hidden" name="_method" value="DELETE">
                                   
                                   <button onclick="return confirm('Esta Seguro que desea Eliminar el Usuario?')" class="btn btn-danger">
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
