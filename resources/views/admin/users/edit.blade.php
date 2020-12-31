@extends('admin.template')

@section('content')
	<div class="container text-center">
		<div class="page-header">
			<h1>
				<i class="fa fa-user"> Usuarios <small>[Editar Usuario]</small></i>
			</h1>
		</div>
		<div class="row">
			<div class="col-md-6 offset-3">
				@if(count($errors)>0)
				@include('admin.partials.error')
				@endif
				<div class="page">
					{!! Form::model($user,['route'=>['users.update',$user->id],'method'=>'PUT'])!!}

						<div class="form-group">
								 {!! Form::label('name', 'Nombre :', array('class' => 'subrayado')) !!} 
					
								{!! Form::text('name', null, array(
												                    'class'=>'form-control',
												                    'required'=>'required',
												                    'placeholder'=>'Nombre Categoria.',
												                    'autofocus'=>'autofocus')) 
			                	!!}
						</div>
						<div class="form-group">
								 {!! Form::label('last_name', 'Apellidos :', array('class' => 'subrayado')) !!} 
					
								{!! Form::text('last_name', null, array(
												                    'class'=>'form-control',
												                    'required'=>'required',
												                    'placeholder'=>'Apellido',
												                    'autofocus'=>'autofocus')) 
			                	!!}
						</div>
						<div class="form-group">
								 {!! Form::label('email', 'Email :', array('class' => 'subrayado')) !!} 
					
								{!! Form::text('email', null, array(
												                    'class'=>'form-control',
												                    'required'=>'required',
												                    'placeholder'=>'Email.',
												                    'autofocus'=>'autofocus')) 
			                	!!}
						</div>
						<div class="form-group">
							{!! Form::label('user', 'Usuario :', array('class' => 'subrayado')) !!} 
							{!!Form::radio('type','user',$user->type=='user' ? true : false)!!} user

							{!!Form::radio('type','admin',$user->type=='admin' ? true : false)!!} admin
						</div>
						<div class="form-group">
							{!! Form::label('active', 'Active :', array('class' => 'subrayado')) !!} 

							{!!Form::checkbox('active',null,$user->active==1 ? true : false)!!} 
						</div>
						<div class="form-group">
							{!! Form::label('address', 'Direccion  :', array('class' => 'subrayado')) !!} 
					
								{!! Form::textarea('address', null, array(
												                    'class'=>'form-control',
												                    'required'=>'required',
												                    'placeholder'=>'Nombre Categoria.',
												                    'autofocus'=>'autofocus')) 
			                	!!}
						</div>
						<fieldset>
							<legend> Cambiar Password</legend>
							<div class="form-group">
								{!! Form::label('password', 'Nuevo Password :', array('class' => 'subrayado')) !!} 
								{!! Form::password(
												'password',
												 array('class'=>'form-control'
												 )
									) 
			                	!!}
								
							</div>
							<div class="form-group">
								{!! Form::label('confirm_password', 'Confirmar Password :', array('class' => 'subrayado')) !!} 

								{!! Form::password(
												'password_confirmation',
												 array('class'=>'form-control'
												 )
									) 
			                	!!}
								
							</div>
						</fieldset>
						<hr>
						<div class="form-group">
							{!!Form::submit('Actualizar',array('class'=>' btn btn-primary'))!!}

							<a href="{{route('users.index')}}" class="btn btn-danger"> Cancelar</a>
						</div>
					{!!Form::close()!!}

				</div>
			</div>
		</div>
	</div>
@stop
