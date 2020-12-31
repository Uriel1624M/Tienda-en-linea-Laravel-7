$(document).ready(function(){

	$('.btn-detalle-pedido').on('click',function (e){
		e.preventDefault();
		var id_pedido=$(this).data('id');
		var path=$(this).data('path');
		var token=$(this).data('token');
		var modal_title=$('.modal-title');
		var modal_body=$('.modal-body');
		var loading='<p> <i class="fa fa-circle-o-notch fa-spin"> </i> Cargando datos</p>';
		var table=$('#table-detalle-pedido tbody');
		var data={'_token':token,'order_id':id_pedido};

		modal_title.html('Detalle de pedido :'+id_pedido);
		table.html(loading);

		$.post(
			path,
			data,
			function(data){
				console.log(data);
				table.html("");
				for (var i = 0; i < data.length; i++) {

					var fila="<tr> ";
					fila+="<td><img src='../storage/"+data[i].articulo.url_imagen+"' width='30'></img></td>";
					fila+="<td>"+data[i].articulo.nombre+"</td>";
					fila+="<td>"+data[i].id_talla+"</td>";
					fila+="<td>"+parseFloat(data[i].articulo.precio).toFixed(2)+"</td>";
					fila+="<td>"+parseInt(data[i].quantity)+"</td>";
					fila+="<td>"+(parseFloat(data[i].quantity)* parseFloat(data[i].precio)).toFixed(2) +"</td>";

					//console.log(data[i].articulo.quantity);


					fila+="</tr>";

					table.append(fila);


				}

			},
			'json'
			);
	});


	//---Update item carrito 
	
	$(".btn-update-estado").on('click',function(e){
		e.preventDefault();

        var id=$(this).data('id');

		var href=$(this).data('href');
		        console.log(href);

		 var estado=$('#estado_'+id).val();

		// //console.log(href+"/"+quantity);
		 window.location.href=href + "/"+estado;

	});  

});