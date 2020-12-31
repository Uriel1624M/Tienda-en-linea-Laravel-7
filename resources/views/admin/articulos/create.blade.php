@extends('admin.template')

@section('content')
	
<div class="container">
	@if(count($errors)>0)
	 @include('admin.partials.error')
	@endif
	  <div class="page-header">
			<h1>
			 <i class="fa fa-shopping-cart"></i>
			   SArticulos <small>[Agregar Articulo]</small>
			</h1>
		</div>


</div>

{!! Form::open(['route'=>['articulos.store'],'method'=>'STORE','files' => 'true', 'role' => 'form'])!!}

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
                      {!! Form::text('nombre', null, array(
    											'class'=>'form-control',
    											'required'=>'required',
    							    			'autofocus'=>'autofocus')) 
    				           !!}
                      <label>Codigo Barras</label>
                        {!! Form::text('cod_barras', null, array(
    											'class'=>'form-control',
    											'required'=>'required',
    							    			'autofocus'=>'autofocus')) 
    				             !!}
                     
                    </div>
                    <!-- /.form-group -->
                    
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6">
                    <div class="form-group">




                      <label>Categoria</label>
                      
                      {!!Form::select('id_categoria', $categorias, null, array('class'=>'form-control select2', 'placeholder'=>'Seleciona una Categoria','style'=>"width: 100%;"))
    					        !!}
                      <label>Marca</label>

                      	{!!Form::select('id_marca', $marcas, null, array('class'=>'form-control', 'placeholder'=>'Seleciona una Marca'))
    					          !!}
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

                      {!! Form::textarea('extract', null, array(
    								  'class'=>'form-control',
    										    'required'=>'required',
    											'placeholder'=>'Descripcion corta',
    										    'autofocus'=>'autofocus',
    										     'rows'=>'3'
    								 )) 
    			       !!}
                    
                    </div>
                    <!-- /.form group -->

                   <div class="form-group">
                      <label>Descripción larga:</label>
    					
    				     {!! Form::textarea('descripcion', null, array(
    								'class'=>'form-control',
    								'required'=>'required',
    								'placeholder'=>'Caracteristicas del  articulo.',
    								'autofocus'=>'autofocus',
    								'rows'=>'5')) 
    			          !!}
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

                      {!! Form::textarea('especificaciones', null, array(
    								  'class'=>'form-control',
    										    'required'=>'required',
    										    'autofocus'=>'autofocus',
    										     'rows'=>'3'
    								 )) 
    			       !!}
                    
                    </div>
                    <!-- /.form group -->

                   <div class="form-group">
                      <label>Datos de interes:</label>

                       {!! Form::textarea('datos_interes', null, array(
    								'class'=>'form-control',
    								'required'=>'required',
    								'autofocus'=>'autofocus',
    								'rows'=>'5')) 
    			          !!}
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
                    
                   <label for="archivosimagenes">Subir  imagen</label> 
                                  
                  {!!Form::file('url_imagen',null, array('required' => 'true')) !!}
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
                    <div class="form-group">

                      <label>Precio</label>
                      {!! Form::text('precio', null, array(
    											'class'=>'form-control',
    										     'required'=>'required',
    									          'placeholder'=>'$',
    											 'autofocus'=>'autofocus')) 
    				                	!!}
                     
                    </div>
                    <!-- /.form-group -->
                    
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                        <!-- checkbox -->
                        <div class="form-group clearfix">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="activo" name="activo">

                            <label class="custom-control-label" for="activo">Activo</label>
                         </div>

                        </div>

                        <div class="form-group">
                        <div class="custom-control custom-switch">
                          <input type="checkbox"  class="custom-control-input" id="sliderprincipal" name="sliderprincipal">
                          <label class="custom-control-label" for="sliderprincipal">Aparece en el Slider principal</label>
                        </div>
                      </div>

                      </div>

                    

           </div>
                <!-- /.row -->
                	<div class="form-group">
    	   								<legend  class="w-auto">Combinaciones</legend>
    	   								<div class="row">
    		   							
    		   								<div class="col-md-4">
    		   									{!!
    											 		Form::label('id_talla', 'Talla', array('class' => 'btn-block'))
    											 !!}
    											 {!!
    								     			Form::select('id_talla',$tallas, null, array('class'=>'form-control', 'placeholder'=>'Please select ...'))
    								   			 !!}
    		   									
    		   								</div>

    		   								<div class="col-md-4">
    		   									{!!
    											 		Form::label('cantidad', 'Cantidad', array('class' => 'btn-block'))
    											 !!}

    											 {!! Form::number('cantidad', null, 
    											 				array('class'=>'form-control',
    														           'placeholder'=>'',
    														           'autofocus'=>'autofocus'
    														        )
    														    ) 
    					                	      !!}
    		   									
    		   								</div>
    		   								
    		   								<div class="col-md-4">
    		   									<button type="button" id="btn_add" class="btn btn-success"> Agregar</button> 
    		   								</div>
    		   							</div>
    							</div>

                <div class="col-md-12">

    							<div class="form-group">
    								<div class="table-responsive">
    									<table class="table table-striped table-bordered table-hover" id="detalles">
    										<thead style="background-color: #A9D0F5">
    											<tr>
    												<th>Opciones</th>
    												<th>Talla</th>
    												<th>Cantidad</th>

    											</tr>
    										</thead>
    										<tfoot>
    												<th>Total :</th>
    												<th></th>
    												<th> <h4 id="total"> $ 0.0</h4> </th>


    										   </tfoot>

    										<tbody>

    										</tbody>
    									</table>
    								</div>
    							</div>
           				
           				
           		</div>



           <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">

                       <a class="btn btn-danger" href="{{route('articulos.index')}}">Cancelar</a>
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

@push('scripts')
<script>
	var contador=0;

	 $(document).ready(function(){
		 	$('#btn_add').click(function (){
		 		agregar();
		 		
		 	});
		 });

	 function agregar(){

	 	    idtalla=$('#id_talla').val();
		  	talla=$('#id_talla option:selected').text();
		    cantidad=$('#cantidad').val();

		    //console.log(idtalla);
		    if (idtalla!="" && cantidad!="") {

		    	var fila='<tr class="selected" id="fila'+contador+'"> <td> <button type="button" class="btn btn-danger" onclick="eliminar('+contador+')"> x</button> </td><td> <input type="hidden" name="idtalla[]" value="'+idtalla+'"></input>'+talla+'</td> <td> <input type="number" name="cantidad[]" value="'+cantidad+'"></input></td>	 </tr>';

		    	limpiar();

		    	$("#detalles").append(fila);


		    }else{
		    	alert("Error al cargar la informacion");

		    }
		    
	 }

	 function limpiar(){
			$("#cantidad").val("");

		}

		function eliminar(index){
			
		    $("#fila"+index).remove();
		    
		}

</script>
@endpush
