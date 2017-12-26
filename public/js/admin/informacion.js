$(document).ready(function()
{
	mostrarTablaInformacion();
});

function mostrarTablaInformacion()
{
	$('#mostrarTablaInformacion').hide();
	$("#mostrarTablaInformacion").fadeOut(1000);
	$("#loader").html("<label class='control-label'>Cargando</label><div class='center-block loader'></div>")
	$("#loader").fadeIn(1000);

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/admin/mostrarTablaInformacion",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		$("#loader").fadeOut(1000);
		$('#mostrarTablaInformacion').hide();
		$('#mostrarTablaInformacion').html(response.html).fadeIn(3000);
	});
}

$("#mostrarTablaInformacion").on("click", "td", function(){

	var id = $(this).attr("id");

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/admin/mostrarInformacionDelPin",
		dataType: 'json',
		data: { id: id }
	})

	.done(function(response) {
		$("#informacion").html(response.html);
	});

});	

