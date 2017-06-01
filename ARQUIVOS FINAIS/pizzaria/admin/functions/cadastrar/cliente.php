<?php

function cadastrarCliente(Array $valores) {
    $pdo = conectar();

    try {
        $cadastraCliente = $pdo->prepare("INSERT INTO clientes(cliente_nome,cliente_cidade,cliente_estado,cliente_bairro,cliente_cep,
                                                cliente_telefone,cliente_celular,cliente_endereco, cliente_nascimento, cliente_login,cliente_senha
                                                )
                                                VALUES(:nome,:cidade,:estado,:bairro,:cep,:telefone,:celular,:endereco, :nascimento, :login,:senha
                                                )");

        foreach ($valores as $k => $value):
            $cadastraCliente->bindValue(":$k", $value);
        endforeach;
        $cadastraCliente->execute();
        
        if ($cadastraCliente->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro ao cadastrar cliente ", $e->getMessage();
    }
}