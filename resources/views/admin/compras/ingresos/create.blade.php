@extends('admin.template')

@section('content')
	
	<div class="container">
		<div class="page-header">
			<h1>
			<i class="fa fa-shopping-cart"></i>
			Ingresos <small>[Agregar Ingreso]</small>
			</h1>
		</div>

		<div class="row
		">
			<div class="col-md-12 offset-md-0">
				@if(count($errors)>0)
				@include('admin.partials.error')
				@endif
				<div class="page">
					{!! Form::open(['route'=>['ingresos.store'],'method'=>'STORE','files' => 'true', 'role' => 'form'])!!}

						<div class="form-group">
							<div class="row">
								<div class="col-md-12">

									{!! Form::label('id_proveedor', 'Proveedor :', array('class' => 'subrayado')) !!} 
					
									{!!
								     	Form::select('id_proveedor', $proveedores, null, array('class'=>'form-control', 'placeholder'=>'Selecciona el proveedor',
								     	'required'=>'required',))
								    !!}
									
								</div>
							</div>
								 
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">

									{!! Form::label('tipo_comprobante', 'Tipo de Comprobante :', array('class' => 'subrayado')) !!}

				                	{!!
								     	Form::select('tipo_comprobante',
								     	['Boleta' => 'Boleta','Factura'=>'Factura','tiket'=>'tiket','Nota'=>'Nota']
										, null, 
										array('class'=>'form-control', 
										'required'=>'required',
										'placeholder'=>'Seleciona tipo Comprobante'))
								   	!!}
									
									
								</div>
								<div class="col-md-4">
								{!! 
							   			Form::label('serie_comprobante', 'Serie de Comprobante:', array('class' => 'negrita')) 
							   		!!}  

								 {!! Form::text('serie_comprobante', null, array(
													                    'class'=>'form-control',
													                    'required'=>'required',
													                    'placeholder'=>'Serie comprobante',
													                    'autofocus'=>'autofocus')) 
				                	!!}
									
							    </div>

								
								<div class="col-md-4">
									{!!
									 		Form::label('num_comprobante', 'Numero Comprobante', array('class' => 'btn-block'))
									 !!}
									  
									 {!! Form::text('num_comprobante', null, 
									 				array(
									 						'class'=>'form-control',
													      	'required'=>'required',
													       	'placeholder'=>'Numero Comprobante',
													        'autofocus'=>'autofocus'
													    )
													) 
				                	!!}
									
								</div>

								
							</div>
													
						</div>

						<fieldset class="border p-2">
							<div class="form-group">
	   								<legend  class="w-auto">Articulos</legend>
	   								<hr>
	   								<div class="row">
		   								<div class="col-md-3">
		   									{!!
											 		Form::label('id_articulo', 'Articulo', array('class' => 'btn-block'))
											 !!}

											 {!!
								     			Form::select('id_articulo', $articulos, null, array('class'=>'form-control', 'placeholder'=>'Please select ...'))
								   			 !!}
		   									
		   								</div>
		   								<div class="col-md-2">
		   									{!!
											 		Form::label('id_talla', 'Talla', array('class' => 'btn-block'))
											 !!}
											 {!!
								     			Form::select('id_talla',['null'=>''], null, array('class'=>'form-control', 'placeholder'=>'Please select ...'))
								   			 !!}
		   									
		   								</div>

		   								<div class="col-md-1">
		   									{!!
											 		Form::label('cantidad', 'Cantidad', array('class' => 'btn-block'))
											 !!}

											 {!! Form::number('cantidad', null, 
											 				array('class'=>'form-control',
														           'placeholder'=>'',
														           'autofocus'=>'autofocus',
														           'min'=>'1'
														        )
														    ) 
					                	      !!}
		   									
		   								</div>
		   								<div class="col-md-2">
		   									{!!
											 		Form::label('precio_compra', 'P.Compra', array('class' => 'btn-block'))
											 !!}
											 {!! Form::text('precio_compra', null, 
											 				array('class'=>'form-control',
														          'placeholder'=>'$',
														          'autofocus'=>'autofocus'
														          )
														    ) 
					                	!!}


		   									
		   								</div>
		   								<div class="col-md-2">
		   									{!!
											 		Form::label('precio_venta', 'Precio Venta', array('class' => 'btn-block'))
											 !!}

											 {!! Form::text('precio_venta', null, 
											 					array('class'=>'form-control',
																			'placeholder'=>'$',
														                    'autofocus'=>'autofocus'
														        	)
														     ) 
					                	    !!}
		   									
		   								</div>
		   								<div class="col-md-2">
		   									<button type="button" id="btn_add" class="btn btn-success"> Agregar</button> 
		   								</div>
		   							</div>
							</div>

							<div class="form-group">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="detalles">
										<thead style="background-color: #A9D0F5">
											<tr>
												<th>Opciones</th>
												<th>Articulo</th>
												<th>Talla</th>
												<th>Cantidad</th>
												<th>Precio Compra</th>
												<th>Precio venta</th>
												<th>SubTotal</th>

											</tr>
										</thead>
										<tfoot>
												<th>Total :</th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th> <h4 id="total"> $ 0.0</h4> </th>


										   </tfoot>

										<tbody>

										</tbody>
									</table>
								</div>
							</div>
						</fieldset>

						<div class="form-group">
							<div class="d-flex mx-2">
								<a  href="{{route('ingresos.index')}}" class="btn btn-warning"> Cancelar</a>

								<div id="guardar">
									{!!Form::submit('Guardar',array('class'=>' btn btn-success'))!!}
								</div>
						  </div>
						</div>

					{!!Form::close()!!}
				</div>
			</div>
		</div>
	</div>

<!--Scrip para llenado de select de acuerdo alas tallas que tine asignadas cada prenda-->
@push('scripts')
	<script>
		$("#id_articulo").change(function(event){
			$("#id_talla").empty();
			$.get("size/"+event.target.value+"",function(response,id_articulo){
				//console.log(response);
				for (i=0; i< response.length;i++) {
					$("#id_talla").append("<option value='"+response[i].id+"'>"+response[i].talla+"</option>	");
				}

			});
		});
	</script>

	<script >
		 var contador=0;
		  total=0;
		  subtotal=[];
		  $("#guardar").hide();

		  function agregar(){
		  	idarticulo=$('#id_articulo').val();
		  	articulo=$('#id_articulo option:selected').text();
		  	idtalla=$('#id_talla').val();
		  	talla=$('#id_talla option:selected').text();
		    cantidad=$('#cantidad').val();
		    preciocompra=$('#precio_compra').val();
		    precioventa=$('#precio_venta').val();

		    if (idarticulo!="" && articulo!="" &&cantidad!="" &&preciocompra!="" &&precioventa!="") {

		    	subtotal[contador]=(cantidad*preciocompra);

		    	total= total+subtotal[contador];
		    	var fila='<tr class="selected" id="fila'+contador+'"> <td> <button type="button" class="btn btn-danger" onclick="eliminar('+contador+')"> x</button> </td> <td> <input type="hidden" name="idarticulo[]" value="'+idarticulo+'"></input>'+articulo+'</td><td> <input type="hidden" name="idtalla[]" value="'+idtalla+'"></input>'+talla+'</td> <td> <input type="number" name="cantidad[]" value="'+cantidad+'"></input></td> <td> $ <input type="hidden" name="preciocompra[]" value="'+preciocompra+'"></input>'+preciocompra+'</td> <td> $ <input type="hidden" name="precioventa[]" value="'+precioventa+'"></input>'+precioventa+'</td> <td> $ '+subtotal[contador]+'</td>	 </tr>';

		    	contador++;
		    	limpiar();
		    	$("#total").html("$"+total);
		    	evaluar();
		    	$("#detalles").append(fila);
		    	
		    }else{
		    	alert("Error al ingresar datos");
		    }


		  }


		 $(document).ready(function(){
		 	$('#btn_add').click(function (){
		 		agregar();
		 	});
		 });


		function limpiar(){
			$("#cantidad").val("");
			$("#precio_compra").val("");
			$("#precio_venta").val("");

		}

		function evaluar(){
			if (total>0) {
				$("#guardar").show();

			}else{
				$("#guardar").hide();

			}
		}

		function eliminar(index){
			total=total-subtotal[index];

		    $("#total").html("$"+total);

		    $("#fila"+index).remove();
		    evaluar();

		}
	</script>
@endpush

@stop
