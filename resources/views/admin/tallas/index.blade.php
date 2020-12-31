@extends('admin.template')

@section('content')
	

	<div class="container text-center">
		<div class="page-header">
			<h1>
				<i class="fa fa-shopping-cart"></i>
				Tallas
				<a href="{{route('tallas.create')}}" class="btn btn-warning"> <i class="fa fa-plus-circle"></i> Talla</a>
			</h1>

		</div>
		<div class="row">
			<div class="col-md-4"></div>

			<div class="col-md-offset-4 col-xs-8 col-md-4">
				@include('admin.tallas.search')
			</div>
		</div>
		

		<div class="page">
			<div class="table-responsive">
			<table class="table table-striped table-bordered-table-hover">
				<thead>
					<tr>
						<th>TALLA</th>
						<th>DESCRIPCION</th>
						<th>ACTUALIZAR</th>
						<th>ELIMINAR</th>

					</tr>
				</thead>
				<tbody>
					@foreach ($tallas as $item)
						<tr>
							<td>{{$item->talla}}</td>
							<td>{{$item->descripcion}}</td>
							<td>
								<a href="{{route('tallas.edit',$item->id)}}" class="btn btn-primary">
									<i class="fa fa-pencil-square"></i>
								</a>
							</td>
							<td> 
								
								{!! Form::open(['route'=>['tallas.destroy',$item->id]])!!}
                                   <input type="hidden" name="_method" value="DELETE">
                                   
                                   <button onclick="return confirm('Esta Seguro que desea Eliminar la Talla?')" class="btn btn-danger">
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
