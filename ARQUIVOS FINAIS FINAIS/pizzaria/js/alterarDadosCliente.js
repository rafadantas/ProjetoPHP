$(document).ready(function() {

	var alterarDados = $("#dadosCliente");

	$("#alterar").on('click', function() {
		var id = $(this).attr('name');
		$.ajax({
			url : 'includes/alterarDadosCliente.php',
			type : 'POST',
			data : 'id=' + id,
			success : function(data) {
				alterarDados.html(data);
				alterarDados.show();
			}
		})
	});
	
	$("#botaoSair").on('click', function(){
		alterarDados.fadeOut('fast');
	})
	
});