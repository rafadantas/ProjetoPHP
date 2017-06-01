<?php

function cadastrarCliente($dados = array()) {
    $pdo = conectar();
    try {

        $cadastraCliente = $pdo->prepare("INSERT INTO clientes(cliente_nome,cliente_cidade,cliente_estado,cliente_bairro,cliente_cep,
                                                cliente_telefone,cliente_celular,cliente_email,cliente_endereco,cliente_nascimento,cliente_login,cliente_senha
                                                )
                                               VALUES(:nome,:cidade,:estado,:bairro,:cep,:telefone,:celular,:email,:endereco,:nascimento,:login,:senha)");
        foreach ($dados as $key => $value) :
            $cadastraCliente->bindValue(":$key", $value);
        endforeach;
        $cadastraCliente->execute();

        if ($cadastraCliente->rowCount() > 0) :
            return true;
        else :
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function cadastroPedido(Array $dados) {
    $pdo = conectar();
    try {

        $cadastrarPedido = $pdo->prepare("INSERT INTO pedidos(pedidos_cliente, pedidos_data, pedidos_tipo_pagamento, pedidos_pizza, pedidos_status, pedidos_qtd)
                                               VALUES(:cliente, :data, :pagamento, :pizza, :status,:quantidade)");
        foreach ($dados as $key => $value) :
            $cadastrarPedido->bindValue(":$key", $value);
        endforeach;
        $cadastrarPedido->execute();

        if ($cadastrarPedido->rowCount() > 0) :
            return true;
        else :
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

