$(document).ready(function() {

	var container = $("#container");
	var menu = container.find($("#menu"));
	var login = menu.find($("#login"));
	var logarCliente = container.find($("#logarCliente"));

	login.on('click', function() {
		formularioLogin();
	});

	var formularioLogin = function() {
		var html = '<form action="" method="POST">';
		html += 'Login: <input type="text" name="login" />';
		html += 'Senha: <input type="text" name="senha" />';
		html += '<input type="submit" name="logar" value="entrar" />';

		logarCliente.html(html);
	}
}); 