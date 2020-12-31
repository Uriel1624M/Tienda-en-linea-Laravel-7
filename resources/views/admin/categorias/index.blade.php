@extends('admin.template')

@section('content')
	

	<div class="container-fluid text-center">
		<div class="page-header">
			<h1>
				<i class="fa fa-shopping-cart"></i>
				Categorias
				<a href="{{route('categoria.create')}}" class="btn btn-warning"> <i class="fa fa-plus-circle"></i> Categorias</a>
			</h1>

		</div>
		<div class="row">
			<div class="col-md-4"></div>

			<div class="col-md-offset-4 col-xs-8 col-md-4">
				@include('admin.categorias.search')
			</div>
		</div>
		

		<div class="page">
			<div class="table-responsive">
			<table class="table table-striped table-bordered-table-hover">
				<thead>
					<tr>
						<th>NOMBRE</th>
						<th>DESCRIPCION</th>
						<th>ACTUALIZAR</th>
						<th>ELIMINAR</th>

					</tr>
				</thead>
				<tbody>
					@foreach ($categorias as $cat)
						<tr>
							<td>{{$cat->nombre}}</td>
							<td>{{$cat->descripcion}}</td>
							<td>
								<a href="{{route('categoria.edit',$cat->id)}}" class="btn btn-primary">
									<i class="fa fa-pencil-square"></i>
								</a>
							</td>
							<td> 
								
								{!! Form::open(['route'=>['categoria.destroy',$cat->id]])!!}
                                   <input type="hidden" name="_method" value="DELETE">
                                   
                                   <button onclick="return confirm('Esta Seguro que desea Eliminar la Categoria?')" class="btn btn-danger">
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
	                 {{ $categorias->links('vendor.pagination.bootstrap-4') }}
	              </ul>
	        </nav>
		</div>
	</div>
@stop
