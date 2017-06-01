<?php

function cadastrarCupom(Array $valores) {
    $pdo = conectar();

    try {
        $cadastrarCupom = $pdo->prepare("INSERT INTO cupom(cupom_nome,cupom_cliente,cupom_vencimento)
                                                VALUES(:nome, :cliente,:vencimento)");

        foreach ($valores as $k => $value):
            $cadastrarCupom->bindValue(":$k", $value);
        endforeach;
        $cadastrarCupom->execute();
        
        if ($cadastrarCupom->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro ao cadastrar cupom ", $e->getMessage();
    }
}