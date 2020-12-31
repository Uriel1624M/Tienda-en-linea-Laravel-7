@extends('admin.template')

@section('content')
	<div class="container text-center">
		<div class="page-header">
			<h1>
			<i class="fa fa-shopping-cart"></i>
			Categorias <small>[Nueva Categoria]</small>
			</h1>
		</div>

		<div class="row
		">
			<div class="col-md-6 offset-md-3">
				@if(count($errors)>0)
				@include('admin.partials.error')
				@endif
				<div class="page">
					{!! Form::open(['route'=>['categoria.store'],'method'=>'STORE'])!!}

						<div class="form-group">
								 {!! Form::label('nombre', 'Nombre :', array('class' => 'subrayado')) !!} 
					
								{!! Form::text('nombre', null, array(
												                    'class'=>'form-control',
												                    'required'=>'required',
												                    'placeholder'=>'Nombre Categoria.',
												                    'autofocus'=>'autofocus')) 
			                	!!}
						</div>
						<div class="form-group">
							{!! Form::label('descripcion', 'Descripcion :', array('class' => 'subrayado')) !!} 
					
								{!! Form::textarea('descripcion', null, array(
												                    'class'=>'form-control',
												                    'required'=>'required',
												                    'placeholder'=>'Descripcion ...',
												                    'autofocus'=>'autofocus')) 
			                	!!}
						</div>
						<div class="form-group">
							{!!Form::submit('Guardar',array('class'=>' btn btn-success'))!!}

							<a href="{{route('categoria.index')}}" class="btn btn-danger"> Cancelar</a>
						</div>
					{!!Form::close()!!}
				</div>
			</div>
		</div>
	</div>
@stop
