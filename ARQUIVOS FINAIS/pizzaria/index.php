<?php
session_start();
include_once "functions/conexao/conexao.php";
include_once "functions/metas/metas.php";
include_once "functions/url/url.php";
include_once "functions/helpers/utils.php";
include_once "functions/logar/logar.php";
include_once "functions/cadastro/cadastro.php";
include_once "functions/update/update.php";
include_once "bibliotecas/Pager/Pager.php";
include_once "bibliotecas/Pager/Sliding.php";

/* LOGIN CLIENTE */
if (isset($_POST['logar'])):
    try {
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
        logarCliente($login, $senha);
    } catch (Exception $e) {
        $erro = $e->getMessage();
    }
endif;
/* LOGIN CLIENTE */

/* LOGOUT CLIENTE */
if (isset($_GET['ac'])):
    if ($_GET['ac'] == 'logout'):
        echo 'sair';
        logOut();
    endif;
endif;
/* LOGOUT CLIENTE */
?>
<!DOCTYPE HTML>
<html>
    <head>   
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="description" content="<?php echo exibeMetas(1); ?>" />
        <meta name="keywords" content="<?php echo exibeMetas(2); ?>" />

        <title>O Senhor das Pizzas</title>
        <link href="http://localhost/pizzaria/css/st.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/pizzaria/css/coin.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div id="container">
            <div id="header">
                
                <div id="busca">
                    <form action="http://localhost/pizzaria/?p=busca" method="POST">
                        <input type="text" name="pizza" id="txt_busca"  />
                        <select name="categoria" id="select_busca">                          
                            <option selected="selected" value="">Escolha uma categoria</option>
                            <?php
                            $listarCategorias = listar('categorias');
                            $d = new ArrayIterator($listarCategorias);
                            while ($d->valid()):
                                ?>
                                <option value="<?php echo $d->current()->categoria_id; ?>"><?php echo $d->current()->categoria_nome; ?></option>
                                <?php
                                $d->next();
                            endwhile;
                            ?>
                        </select>
                        <input type="submit" name="buscar_pizza" value="ok" id="bt_busca"/>
                    </form>
                </div><!--BUSCA-->
            </div><!--HEADER-->

            <div id="menu">
                <ul>
                    <li><a href="http://localhost/pizzaria/">Home</a></li>
                    <li><a href="http://localhost/pizzaria/empresa">A Empresa</a></li>
                    <li><a href="http://localhost/pizzaria/cliente">Área do cliente</a></li>
                    <li><a href="http://localhost/pizzaria/cadastro">Cadastro</a></li>
                    <li><a href="http://localhost/pizzaria/contato">Contato</a></li>
                    <li><a href="http://localhost/pizzaria/pizzas">Pizzas</a></li>
                    <li><a href="#" id="login">Login</a></li>
                </ul>
            </div><!--MENU-->


            <div id="logarCliente">
                <?php if (!isset($_SESSION['logado_cliente'])): ?>
                    <?php echo isset($erro) ? '<img src="http://localhost/pizzaria/images/alert.png" /><span id="erroLogar">' . $erro . '</span>' : 'Seja bem Vindo visitante' ?>		
                <?php else: ?>
                    Bem Vindo: <?php echo $_SESSION['nome_cliente']; ?> | <a href="http://localhost/pizzaria/?ac=logout">sair</a>
                <?php endif; ?>
            </div><!--MENSAGEM LOGADO-->

            <div id="conteudo">    
                <?php
                if (!isset($_GET['p'])):
                    include_once 'includes/home.php';
                else:
                    carregaUrlAmigavel($_GET['p']);
                endif;
                ?>       
                <div id="fix"></div><!--FIX-->
            </div><!--CONTEUDO-->


            <!--contato@asolucoesweb.com.br-->

            <div id="footer">Pizzaria de Net <?php echo date("Y"); ?> - Todos direitos reservados</div><!--RODAPE-->
        </div><!--CONTAINER-->

        <script type="text/javascript" src="http://localhost/pizzaria/js/jquery.js"></script>
        <script type="text/javascript" src="http://localhost/pizzaria/js/coin-slider.min.js"></script>
        <script type="text/javascript" src="http://localhost/pizzaria/js/coinSliderInit.js"></script>
        <script type="text/javascript" src="http://localhost/pizzaria/js/login.js"></script>
        <script type="text/javascript" src="http://localhost/pizzaria/js/validate.js"></script>
        <script type="text/javascript" src="http://localhost/pizzaria/js/validarCadastro.js"></script>
        <script type="text/javascript" src="http://localhost/pizzaria/js/mascara.js"></script>
        <script type="text/javascript" src="http://localhost/pizzaria/js/mascaraInputs.js"></script>
        <script type="text/javascript" src="http://localhost/pizzaria/js/alterarDadosCliente.js"></script>
    </body>
</html>