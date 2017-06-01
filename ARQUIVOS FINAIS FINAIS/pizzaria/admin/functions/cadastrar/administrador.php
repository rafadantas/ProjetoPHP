<?php

function cadastrarAdministrador(Array $valores) {
    $pdo = conectar();

    try {
        $cadastraAdministrador = $pdo->prepare("INSERT INTO administrador(administrador_nome,administrador_login,administrador_senha)
                                                VALUES(:nome, :login,:senha)");

        foreach ($valores as $k => $value):
            $cadastraAdministrador->bindValue(":$k", $value);
        endforeach;
        $cadastraAdministrador->execute();
        
        if ($cadastraAdministrador->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro ao cadastrar administrador ", $e->getMessage();
    }
}