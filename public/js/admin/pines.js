$(document).ready(function()
{
	
});

function mostrarTablaUsuarios()
{
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/admin/mostrarTablaUsuarios",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		$('#mostrarTablaUsuarios').html(response.html);
	});
}
