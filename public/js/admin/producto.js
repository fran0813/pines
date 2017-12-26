$(document).ready(function()
{
	mostrarTablaProductos();
});

function mostrarTablaProductos()
{
	$('#mostrarTablaProductos').hide();
	$('#respuestaCrearPines').hide();
	$("#mostrarTablaProductos").fadeOut(1000);
	$("#loader").html("<label class='control-label'>Cargando</label><div class='center-block loader'></div>")
	$("#loader").fadeIn(1000);

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/admin/mostrarTablaProductos",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		$("#loader").fadeOut(1000);
		$('#mostrarTablaProductos').hide();
		$('#mostrarTablaProductos').html(response.html).fadeIn(3000);
	});
}

$("#mostrarTablaProductos").on("click", "a", function(){

	var value = $(this).attr("value");
	var id = $(this).attr("id");

	if (value == "actualizar") {
		$('#respuestaActualizarProducto').html("");
		$('#idActualizarProducto').val(id);
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			method: "POST",
			url: "/admin/mostrarActualizarProducto",
			dataType: 'json',
			data: { id: id }
		})

		.done(function(response) {
			$('#actualizarProducto').val(response.name);
			$('#actualizarDescripcion').val(response.description);
		});
	} else if (value == "eliminar"){
		$('#idEliminarProducto').val(id);
	} else if (value == "informacion") {
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			method: "POST",
			url: "/admin/idProducto",
			dataType: 'json',
			data: { id: id }
		})

		.done(function(response) {
			location.href = '/admin/informacion';
		});
	}
});

$("#formActualizarProducto").on("submit", function()
{
	var id = $("#idActualizarProducto").val();
	var name = $("#actualizarProducto").val();
	var description = $("#actualizarDescripcion").val();

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/admin/actualizarProducto",
		dataType: 'json',
		data: { id: id,
				name: name, 
				description: description }
	})

	.done(function(response){
		mostrarTablaProductos();
		$('#respuestaActualizarProducto').html(response.html);
	});
	
	return false;
});

$("#formEliminarProducto").on("submit", function()
{
	$('#repuestaEliminarProducto').html("Se esta eliminando, por favor espere");
	$('#modalCargar').modal({backdrop: 'static', keyboard: false}).fadeIn(400);
	$('#loader2').html("<label class='control-label' style='color: #000000'>Cargando</label><div class='center-block loader'></div>");
	$('#loader2').fadeIn(1000);
	document.body.style.cursor = "wait";	
	var id = $("#idEliminarProducto").val();

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/admin/eliminarProducto",
		dataType: 'json',
		data: { id: id }
	})

	.done(function(response){
		mostrarTablaProductos();
		
		setTimeout(function(){
			$('#repuestaEliminarProducto').html(response.html);
		}, 500);

		$('#modalCargar').modal('hide').fadeOut(1000);
		$('#loader2').fadeOut(1000);
		document.body.style.cursor = "auto";

		setTimeout(function(){
			$('#modalEliminarProducto').modal('hide').fadeOut(1000);
		}, 100);
	});

	return false;
});

$(document).bind('keydown',function(eEvento){
    if(eEvento.which == 27) { 
        var $jQuery = window.parent.$;
        $jQuery('body').find('#modalActualizarProducto').trigger('click');
        $jQuery('body').find('#modalEliminarProducto').trigger('click');
    }
});