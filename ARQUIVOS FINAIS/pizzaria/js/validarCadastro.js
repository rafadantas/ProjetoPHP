$(document).ready(function() {	
	
	var botaoLimpar = $("#cadastro").find("#limpar");
	
	// validate signup form on keyup and submit
	$("#formularioCadastro").validate({
		rules: {
			nome: "required",
			cidade: "required",
			estado: {
				required: true,
				maxlength: 2
			},
			bairro:"required",
			cep:"required",
			telefone: 'required',
			celular:'required',
			email: {
				required: true,
				email: true
			},
			endereco: 'required',
			nascimento: 'required',
			login: 'required',
			senha: 'required'
		},
		messages: {
			nome: "<span class='erro'>Por favor digite um nome</span>",
			cidade: "<span class='erro'>Por favor digite sua cidade</span>",
			estado: "<span class='erro'>Por favor digite seu estado</span>",
			bairro: "<span class='erro'>Por favor digite seu bairro</span>",
			cep: "<span class='erro'>Por favor digite seu cep</span>",
			telefone: "<span class='erro'>Por favor digite seu telefone</span>",
			celular: "<span class='erro'>Por favor digite seu celular</span>",
			email: "<span class='erro'>Por favor digite um email válido</span>",
			endereco: "<span class='erro'>Por favor digite seu endereço</span>",
			nascimento: "<span class='erro'>Por favor digite sua data de nascimento</span>",
			login: "<span class='erro'>Por favor digite seu login</span>",
			senha: "<span class='erro'>Por favor digite sua senha</span>",
		}
	});
	
	
	botaoLimpar.on('click', function(event){
		event.preventDefault();
		limparFormularioCadastro();
	})
	
	var limparFormularioCadastro = function(){
		$("#nome").val('');
		$("#cidade").val('');
		$("#estado").val('');
		$("#bairro").val('');
		$("#cep").val('');
		$("#telefone").val('');
		$("#celular").val('');
		$("#email").val('');
		$("#endereco").val('');
		$("#nascimento").val('');
		$("#login").val('');
		$("#senha").val('');
	}
	
});	
