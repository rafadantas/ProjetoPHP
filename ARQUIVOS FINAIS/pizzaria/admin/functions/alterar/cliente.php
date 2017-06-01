<?php
function alterarCliente(Array $dadosCliente) {
    $pdo = conectar();
    try {

        $alterarAdmin = $pdo->prepare("UPDATE clientes SET cliente_nome = :nome, 
                                                           cliente_cidade = :cidade,
                                                           cliente_estado = :login,
                                                           cliente_bairro = :bairro, 
                                                           cliente_cep = :cep,
                                                           cliente_telefone = :telefone,
                                                           cliente_celular = :celular,
                                                           cliente_endereco = :endereco,
                                                           cliente_nascimento = :nascimento,
                                                           cliente_login = :login,
                                                           cliente_senha = :senha
                                                           WHERE cliente_id = :id");
        foreach ($dadosCliente as $k => $value):
            $alterarAdmin->bindValue(":$k", $value);
        endforeach;
        $alterarAdmin->execute();
        
        if ($alterarAdmin->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
