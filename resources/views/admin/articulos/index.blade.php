@extends('admin.template')

@section('content')
	
	<div class="container-fluid text-center">
		<div class="page-header">
			<h1>
				<i class="fa fa-shopping-cart"></i>
				Articulos
				<a href="{{route('articulos.create')}}" class="btn btn-warning"> <i class="fa fa-plus-circle"></i> Articulos</a>
			</h1>

		</div>

		<div class="page">
			<div class="table-responsive">
			<table class="table table-striped table-bordered-table-hover">
				<thead>
					<tr>
						<th>CODIGO BARRAS</th>
						<th>SKU</th>
						<th>NOMBRE</th>
						<th>IMAGEN</th>
						<th>PRECIO UNITARIO</th>
						<th>VISIBLE</th>
						<th>ACTUALIZAR</th>
						<th>ELIMINAR</th>

					</tr>
				</thead>
				<tbody>
					@foreach ($articulos as $articulo)
						<tr>
							<td>{{$articulo->cod_barras}}</td>
							<td>{{$articulo->sku}}</td>
							<td>{{$articulo->nombre}}</td>
							<td><img src="{{ asset("storage/$articulo->url_imagen" )}}" width="40" height="40"></td>
							<td> $ {{$articulo->precio}}</td>
							<td>{{$articulo->visible==1 ? "SI" : "NO"}}</td>

							<td>
								<a href="{{route('articulos.edit',$articulo->id)}}" class="btn btn-primary">
									<i class="fa fa-pencil-square"></i>
								</a>
								<!-- <a href="route('edit-articulos',[$articulo->id,$articulo->id_talla])" class="btn btn-primary">

									<i class="fa fa-pencil-square"></i>
								</a>
 -->
							</td>
							<td> 
								
								{!! Form::open(['route'=>['articulos.destroy',$articulo->id]])!!}
                                   <input type="hidden" name="_method" value="DELETE">
                                   
                                   <button onclick="return confirm('Esta Seguro que desea Eliminar el Articulo?')" class="btn btn-danger">
                                    <i class=" fa fa-trash"></i>
                                   </button>
                                  {!!Form::close()!!}

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<nav>
                   <ul class="pagination justify-contend-end">
                               {{ $articulos->links('vendor.pagination.bootstrap-4') }}
                    </ul>
              </nav>
		</div>		
		</div>
	</div>


@stop
