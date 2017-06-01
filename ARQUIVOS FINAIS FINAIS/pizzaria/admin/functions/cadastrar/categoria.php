<?php

function cadastrarCategoria($categoria) {
    $pdo = conectar();
    try {
      
        $cadastrarCategoria = $pdo->prepare("INSERT INTO categorias(categoria_nome)VALUES(:categoria)");
        $cadastrarCategoria->bindValue(":categoria", $categoria);
        $cadastrarCategoria->execute();

        if ($cadastrarCategoria->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro ao cadastrar categoria !" . $e->getMessage();
    }
}
