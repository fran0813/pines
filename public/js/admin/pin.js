$(document).ready(function()
{
	
});

$("#formGenerarPines").on("submit", function()
{
	var number = $("#numero").val();
	var name = $("#titulo").val();
	var description = $("#descripcion").val();

	$('#tablaPinesGenerados').hide();
	$("#respuestaCrearNumeros").html("");
	$("#tablaPinesGenerados").fadeOut(1000);
	$("#loader").html("<label class='control-label'>Cargando</label><div class='center-block loader'></div>")
	$("#loader").fadeIn(1000);

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/admin/generarPines",
		dataType: 'json',
		data: { number: number,
				name: name,
				description: description }
	})

	.done(function(response){
		$("#loader").fadeOut(1000);
		$('#tablaPinesGenerados').hide();
		$('#tablaPinesGenerados').html(response.html).fadeIn(3000);
		$('#respuestaCrearPines').hide();
		$('#respuestaCrearPines').html(response.pin).delay(100).fadeIn(2000);
	});

	return false;
});
