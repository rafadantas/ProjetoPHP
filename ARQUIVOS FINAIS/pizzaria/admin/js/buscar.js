/**
 * @author Alexandre
 */
$(document).ready(function(){
	
    var txt_busca 	= $("#txt_busca"),
    carregar 	= $("#carregar"),
    form_busca 	= $("#form_busca"),
    link 		= $("#tabela");
	
	
    txt_busca.keyup(function(){
        carregarBusca();
    });
	
	
    var carregarBusca = function(){
        nomeDigitado = txt_busca.val();
		
        if(nomeDigitado == ""){
            //CARREGA A PAGINA INICIAL
             $(location).attr('href', 'http://localhost/pizzaria/admin/inc/painel.php');
        }else{
            $.ajax({
				
                type: 'POST',
                url: 'buscar.php',
                data: form_busca.serialize(),
                success: function(data){
                    carregar.html(data);
                    oddEven();
                }
				
            });
			
        };
    }
	
    var oddEven = function(){
        $("tr:odd").addClass('odd');
        $("tr:even").addClass('even');
    }
	
});