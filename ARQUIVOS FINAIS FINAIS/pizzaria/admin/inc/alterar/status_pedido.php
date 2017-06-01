<?php

if (isset($_POST['status'])):

    include_once '../../functions/alterar/status.php';
    include_once '../../functions/conexao/conexao.php';
    include_once '../../functions/helpers/utils.php';

    $status = $_POST['status'];
    $id = $_POST['id'];
    $data = $_POST['data'];


    $dados = pegarPeloId('pedidos', 'pedidos_id', $id);
    $dataPedido = $dados['pedidos_data'];

    if ($dataPedido == $data):
        $dataUpdate = $dataPedido;
    else:
        $dataUpdate = $data;
    endif;


    if ($status == 'entregue'):
        $statusAlterar = 'pendente';
    else:
        $statusAlterar = 'entregue';
    endif;

    /* ALTERAR STATUS */
    if (alterarStatus($statusAlterar, $id, $dataUpdate)):
        echo "Alterado com sucesso !";
    else:
        echo 'Erro ao alterar status';
    endif;

else:
    echo "Para alterar o starus, você precisa clicar no status desejado !";
endif;