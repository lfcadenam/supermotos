$(function () {
	load(0);
});
function load(page) {
	var query = $("#name").val();
	var marca = $("#marca").val();
	var linea = $("#linea").val();
	var per_page = $("#per_page").val();
	var parametros = { "action": "ajax", "page": page, 'query': query, 'marca': marca, 'linea': linea, 'per_page': per_page };
	$("#loader").fadeIn('slow');
	$.ajax({
		url: 'motos_dispo_ajax.php',
		data: parametros,
		beforeSend: function (objeto) {
			$("#loader").html("Cargando...");
		},
		success: function (data) {
			$(".datos_ajax").html(data).fadeIn('slow');
			$("#loader").html("");
		}
	})
}