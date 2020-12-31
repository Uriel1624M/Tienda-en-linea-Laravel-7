$(document).ready(function() {


	//---Update item carrito 
	
	$(".btn-update-item").on('click',function(e){
		e.preventDefault();

		var id=$(this).data('id');

		var href=$(this).data('href');
		var quantity=$('#articulo_'+id).val();

		//console.log(href+"/"+quantity);
		window.location.href=href + "/" + quantity;

	});
	//fin btn carrito

	//inicio lupa
	
	
	//fin lupa


});
