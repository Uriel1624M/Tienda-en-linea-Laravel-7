@extends('admin.template')

@section('content')
	
	<div class="container-fluid text-center">
		<div class="page-header">
			<h1>
				<i class="fa fa-shopping-cart"></i>
				Stock
				<small>[Disponible x Combinacion]</small>
			</h1>


		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				
						{!! Form::open(['route'=>'articulotalla.index','method'=>'GET','class'=>'form-search content-search navbar-form','role'=>'search'])!!}
							<div class="input-group d-flex mx-1">
									<input type="text" name="search" class="form-control form-text" type="text" size="15" maxlength="128" placeholder="Buscar">

									<span class="input-group-btn">

						                <button type="submit" class="btn btn-primary">
						                	<span class="fa fa-search" aria-hidden="true"></span>
						                </button>
									</span>
							</div>

						{!!Form::close()!!}
				
			</div>
			<div class="col-md-4">
				<a href="{{route('excel.index')}}" class="btn btn-success"> Exportar <i class="fa fa-file-excel-o fa-lg"> </i> </a>
			</div>
		</div>

		<div class="page">
			<div class="table-responsive">
			<table class="table table-striped table-bordered-table-hover">
				<thead>
					<tr>
						<th>SKU</th>
						<th>NOMBRE</th>
						<th>TALLA</th>
						<th>IMAGEN</th>
						<th>STOCK</th>
						<th>PRECIO UNITARIO</th>
						<th>VISIBLE</th>
						<th>ACTUALIZAR</th>
						<th>ELIMINAR</th>

					</tr>
				</thead>
				<tbody>
					@foreach ($articulos as $articulo)
						<tr>
							<td>{{$articulo->cod_identificacion}}</td>
							<td>{{$articulo->nombre}}</td>
							<td>{{$articulo->talla}}</td>
							<td><img src="{{ asset("storage/$articulo->url_imagen" )}}" width="40" height="40"></td>
							<td>{{$articulo->stock}}</td>
							<td> $ {{$articulo->precio}}</td>
							<td>{{$articulo->visible==1 ? "SI" : "NO"}}</td>

							<td>
								<a href="{{route('articulotalla.edit',$articulo->cod_identificacion)}}" class="btn btn-primary">
									<i class="fa fa-pencil-square"></i>
								</a>
								<!-- <a href="route('edit-articulos',[$articulo->id,$articulo->id_talla])" class="btn btn-primary">

									<i class="fa fa-pencil-square"></i>
								</a>
 -->
							</td>
							<td> 
								
								{!! Form::open(['route'=>['articulotalla.destroy',$articulo->cod_identificacion]])!!}
                                   <input type="hidden" name="_method" value="DELETE">
                                   
                                   <button onclick="return confirm('Esta Seguro que desea Eliminar esta variante ?')" class="btn btn-danger">
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
