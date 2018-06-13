/*$(document).ready(function(){
	$("#ocultarDivs").click(function(){
		$("#jbtDetalle").toggle("slow");
	});

	$("#btn1").click(function(){
		$("#jbtDetalle").toggle("slow");
		$.ajax({url: "demo_test.txt", success: function(result){
			$("#div1").html(result);
		}});

	});
});*/
/*
function mostrarDetGuias(ori, dest, jefeDest){
	var parametros = {
		"origen" : ori,
		"destino" : dest,
		"jefeDestino": jefeDest
	};
	$.ajax({
		data:  parametros,
		url:   'ejemplo_ajax_proceso.php',
		type:  'post',
		beforeSend: function () {
			$("#wait_1").html("Procesando, espere por favor Procesando...");
		},
		success:  function (response) {
			$("#jbtDetalle").html(response);
		}
	});
}
*/