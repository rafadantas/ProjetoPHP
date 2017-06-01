<?php

function alterarcategoria($categoria,$id) {
    $pdo = conectar();
    try {

        $alterarcat = $pdo->prepare("UPDATE categorias SET categoria_nome = :nome WHERE categoria_id = :id");
      
        $alterarcat->bindValue(":nome", $categoria);
        $alterarcat->bindValue(":id", $id);
        $alterarcat->execute();

        if ($alterarcat->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
