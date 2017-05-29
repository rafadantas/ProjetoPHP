<?php

session_start();
include_once 'functions/config/config.php';

try {
	carregaIncludes(array("conexao","login"), "login");
} catch (Exception $e) {
	echo $e->getMessage();	
}

if($_SERVER['REQUEST_METHOD']=='POST'):
	if(isset($_POST['logar'])):
		$login = addslashes($_POST['login']);
		$senha = addslashes($_POST['senha']);

		if(logar($login,$senha)):
			header("Location: inc/painel.php");
			else:
				$erro = "usuario ou senha invalidos";
		endif;
	endif;
endif;	

?>

<html>
    <head>   
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Administrador - O Senhor das Pizzas</title>
        <link href="css/style_login.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <div id="container">
            
            <div id="login">
                <div id="titulo">
                    Administrador - O Senhor das Pizzas
                </div>
                <div id="conteudo_login"> 
                
                    <div id="cadeado">
                        <img src="images/cadeado.png" title="login" alt="login administrador" />
                    </div>

                    <div id="form_login">
                        <form action="" method="POST">
                                <label for="login_nome">Login:</label>
                                <input type="text" name="login" class="input_text_login"></input>

                                <label for="senha">Senha:</label>
                                <input type="password" name="senha" class="input_text_login"></input>
                                <input type="submit" name="logar" value="" id="botao_logar" />
                        </form>
                    </div>
                </div>
                <div id="fix"></div>
            </div>

            <?php
            if (isset($erro)):
                if (!empty($erro)):
                    ?>
                    <div class="erro">
                        <?php
                        echo $erro;
                        ?>
                    </div><!--ERRO-->
                    <?php
                endif;
            endif;
            ?>
        </div>
        

           
    </body>
</html>