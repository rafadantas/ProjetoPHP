<?php
function alterarAdministrador(Array $dadosAdministrador) {
    $pdo = conectar();
    try {

        $alterarAdmin = $pdo->prepare("UPDATE administrador SET administrador_nome = :nome, administrador_login = :login,
                                        administrador_senha = :senha WHERE administrador_id = :id");
        foreach ($dadosAdministrador as $k => $value):
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
