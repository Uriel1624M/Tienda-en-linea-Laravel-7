@extends('admin.template')

@section('content')
	
<!---->
<div class="container">
	@if(count($errors)>0)
	@include('admin.partials.error')
	@endif
			<div class="page-header">
			<h1>
			<i class="fa fa-shopping-cart"></i>
			Articulos <small>[Editar Stock]</small>
			</h1>
		</div>


</div>

<section class="content">
		<div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Datos del producto</h3>
          
          </div>

          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">

                  <label>Nombre</label>
                  <p>{{$articulo->nombre}}</p>

                  <label>SKU</label>
                    <p>{{$articulo->cod_identificacion}}</p>
                 
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">




                  <label>Talla</label>
                  
					         <p>{{$articulo->talla}}</p>

                  	<p></p>
                </div>
                <!-- /.form-group -->
    
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->


          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           
        </div>
      </div>

        <!-- /.card -->

        <div class="row">
          <div class="col-md-6">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Descripciones del producto</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label>Descripción corta:</label>

                 <p>{{$articulo->extract}}</p>
                
                </div>
                <!-- /.form group -->

               <div class="form-group">
                  <label>Descripción larga:</label>
					
				      <p>{{$articulo->descripcion}}</p>
                </div>                

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

       </div>
        <!-- /.col-md-6 -->




          <div class="col-md-6">

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Especificaciones y otros datos</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label>Especificaciones:</label>

                 <p>{{$articulo->especificaciones}}</p>
                </div>
                <!-- /.form group -->

               <div class="form-group">
                  <label>Datos de interes:</label>
                    <p>{{$articulo->datos_interes}}</p>
                </div>                

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

       </div>
        <!-- /.col-md-6 -->



      </div>
      <!-- /.row -->

        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Imagen</h3>

           
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="form-group">
                

                              
              <img src="{{ asset("storage/$articulo->url_imagen" )}}" height="100px" width="100px">
            </div>


          </div>


          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
        </div>
        <!-- /.card -->

         <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Administración</h3>
          </div>
          <!-- /.card-header -->
      <div class="card-body">

       <div class="row">

              <div class="col-md-6">

{!! Form::model($articulo,['route'=>['articulotalla.update',$articulo->id_art],'method'=>'PUT','files' => true, 'role' => 'form'])!!}
                <div class="form-group">

                  <label>Stock</label>
                  {!! Form::number('stock', null, array(
											'class'=>'form-control',
										     'required'=>'required',
									          'placeholder'=>'',
											 'autofocus'=>'autofocus')) 
				                	!!}
                 
                </div>
                <!-- /.form-group -->
               

                
              </div>
              <!-- /.col -->
              

                

       </div>
            <!-- /.row -->
            	
       <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                   <a class="btn btn-danger" href="{{route('articulotalla.index')}}">Cancelar</a>
                   <input                  
                  type="submit" value="Guardar" class="btn btn-primary">
                 
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->
                

         </div>
            <!-- /.row -->




          </div>


   
          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
        </div>
        <!-- /.card -->


</section>

 {!!Form::close()!!}

@stop
