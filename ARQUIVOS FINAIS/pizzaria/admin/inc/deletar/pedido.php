<?php

if (isset($_POST['id']) AND $_POST['id'] > 0):

    include_once '../../functions/deletar/pedido.php';
    include_once '../../functions/conexao/conexao.php';

    $id = $_POST['id'];

    /* DELETAR PEDIDO */
    if (deletarPedido($id)):
        echo "Deletado com sucesso !";
    else:
        echo 'Erro ao alterar status';
    endif;

else:
    echo "Para alterar o starus, você precisa clicar no status desejado !";
endif;