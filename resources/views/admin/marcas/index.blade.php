@extends('admin.template')

@section('content')
	

	<div class="container text-center">
		<div class="page-header">
			<h1>
				<i class="fa fa-shopping-cart"></i>
				Marcas
				<a href="{{route('marcas.create')}}" class="btn btn-warning"> <i class="fa fa-plus-circle"></i> Marca</a>
			</h1>

		</div>
		<div class="row">
			<div class="col-md-4"></div>

			<div class="col-md-offset-4 col-xs-8 col-md-4">
				@include('admin.marcas.search')
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
					@foreach ($marcas as $cat)
						<tr>
							<td>{{$cat->marca}}</td>
							<td>{{$cat->descripcion}}</td>
							<td>
								<a href="{{route('marcas.edit',$cat->id)}}" class="btn btn-primary">
									<i class="fa fa-pencil-square"></i>
								</a>
							</td>
							<td> 
								
								{!! Form::open(['route'=>['marcas.destroy',$cat->id]])!!}
                                   <input type="hidden" name="_method" value="DELETE">
                                   
                                   <button onclick="return confirm('Esta Seguro que desea Eliminar la Marca?')" class="btn btn-danger">
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
	                 {{ $marcas->links('vendor.pagination.bootstrap-4') }}
	              </ul>
	        </nav>		
		</div>
	</div>
@stop
