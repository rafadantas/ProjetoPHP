<?php
session_start();
include_once '../functions/config/config.php';

try {
    carregaIncludes(array("conexao","login", "url"), "admin");
} catch (Exception $e) {
    echo $e->getMessage();  
}

verificaLogado('logado_admin');

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title> Administrador - O Senhor das Pizzas </title>
        <link href="../css/estilo_painel.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <div id="container">
            <div id="header">
                <div id="logo">
                    <a href="http://localhost/testapizza/admin/inc/painel.php">O Senhor das Pizzas
                    <br />
                    <span id="sublogo">A melhor pizzaria da cidade</span><!--SUBLOGO--> 
                    </a>
                </div><!--LOGO-->

                <div id="busca">
                    <form action="" method="POST" id="form_busca">
                        <input type="text" name="busca" id="txt_busca">
                        </input>
                    </form>
                    <div id="lupa">
                        <img src="../images/lupa.png"></img>
                    </div><!--LUPA-->
                </div><!--BUSCA-->
            </div><!--HEADER-->

            <div id="conteudo">
                <div id="menuLateral">
                    <ul>
                        <li><a href="?p=cadastrar_pizza">Cadastrar Pizza</a></li>
                        <li><a href="?p=cadastrar_foto">Cadastrar Foto</a> </li>
                        <li><a href="?p=cadastrar_cliente">Cadastrar Cliente</a></li>
                        <li><a href="?p=cadastrar_categoria">Cadastrar Categoria</a> </li>
                        <li> <a href="?p=cadastrar_administrador">Cadastrar Administrador</a></li>
                        <li><a href="?p=cadastrar_metas">Cadastrar Metas Tags</a></li>
                    </ul>
                    <br/>
                    <ul>
                        <li><a href="?p=alterar_pizza">Alterar Pizza</a></li>
                        <li><a href="?p=alterar_foto">Alterar Foto</a></li>
                        <li><a href="?p=alterar_cliente">Alterar Cliente</a> </li>
                        <li><a href="?p=alterar_categoria">Alterar Categoria</a></li>
                        <li><a href="?p=alterar_administrador">Alterar Administrador</a></li>
                        <li><a href="?p=alterar_metas">Alterar Metas</a></li>
                    </ul>
                    <br/>
                    <ul>
                        <li><a href="?p=deletar_pizza">Deletar Pizza</a></li>
                        <li><a href="?p=deletar_foto">Deletar Foto</a></li>
                        <li><a href="?p=deletar_cliente">Deletar Cliente</a></li>
                        <li><a href="?p=deletar_categoria">Deletar Categoria</a></li>
                        <li><a href="?p=deletar_administrador">Deletar Administrador</a></li>
                    </ul>
                    <br/>
                    <ul>
                        <li><a href="?p=dados_pedidos">Relatórios dos pedidos</a></li>
                        <li><a href="?p=dados_aniversariantes">Aniversariantes</a></li>
                    </ul>
                </div>

                <div id="conteudoAdmin">
                    <!--MENSAGEM DE BOAS VINDAS-->
                    
                        <?php
                        if (isset($_GET['p'])) :
                            try {
                                carregaUrls($_GET['p']);
                            } catch (Exception $e) {
                                echo $e->getMessage();
                            }
                        else :
                            include_once "home.php";
                        endif;
                        ?>
                </div>
            </div>

        </div>
        <div id="fix"></div>
        <!--<div id="rodape">
            O Senhor das Pizzas <?php echo date("Y"); ?>
            - Painel Administrativo
        </div>--><!--RODAPE-->
        

    </body>
</html>