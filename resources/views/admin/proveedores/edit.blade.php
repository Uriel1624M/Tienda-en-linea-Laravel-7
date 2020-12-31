@extends('admin.template')

@section('content')
	<div class="container text-center">
		<div class="page-header">
			<h1>
				<i class="fa fa-user"> Proveedores <small>[Nuevo Proveedor]</small></i>
			</h1>
		</div>
		<div class="row">
			<div class="col-md-6 offset-3">
				@if(count($errors)>0)
				@include('admin.partials.error')
				@endif
				<div class="page">
					
					{!! Form::model($proveedor,['route'=>['proveedor.update',$proveedor->id],'method'=>'PUT'])!!}

						<div class="form-group">
								 {!! Form::label('nombre', 'Nombre Completo:', array('class' => 'subrayado')) !!} 
					
								{!! Form::text('nombre', null, array(
												                    'class'=>'form-control',
												                    'required'=>'required',
												                    'placeholder'=>'',
												                    'autofocus'=>'autofocus')) 
			                	!!}
						</div>
						<div class="form-group">
								 {!! Form::label('telefono', 'Telefono :', array('class' => 'subrayado')) !!} 
					
								{!! Form::text('telefono', null, array(
												                    'class'=>'form-control',
												                    'required'=>'required',
												                    'autofocus'=>'autofocus')) 
			                	!!}
						</div>
						<div class="form-group">
								 {!! Form::label('email', 'Email :', array('class' => 'subrayado')) !!} 
					
								{!! Form::text('email', null, array(
												                    'class'=>'form-control',
												                    'required'=>'required',
												                    'placeholder'=>'',
												                    'autofocus'=>'autofocus')) 
			                	!!}
						</div>
						
						<div class="form-group">
							{!! Form::label('direccion', 'Direccion  :', array('class' => 'subrayado')) !!} 
					
								{!! Form::textarea('direccion', null, array(
												                    'class'=>'form-control',
												                    'required'=>'required',
												                    'placeholder'=>'',
												                    'autofocus'=>'autofocus')) 
			                	!!}
						</div>
						
						<hr>
						<div class="form-group">
							{!!Form::submit('Guardar',array('class'=>' btn btn-primary'))!!}

							<a href="{{route('proveedor.index')}}" class="btn btn-danger"> Cancelar</a>
						</div>
					{!!Form::close()!!}

				</div>
			</div>
		</div>
	</div>
@stop
