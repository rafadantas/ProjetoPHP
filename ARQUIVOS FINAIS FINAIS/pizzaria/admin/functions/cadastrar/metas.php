<?php

function cadastrarMetas($tipo, $texto) {
    
    $pdo = conectar();
    try {
      
        $cadastrarmetas = $pdo->prepare("INSERT INTO metas(meta_tipo, meta_texto)
                                             VALUES(:tipo, :texto)");
           $cadastrarmetas->bindValue(":tipo", $tipo);
           $cadastrarmetas->bindValue(":texto", $texto);
           $cadastrarmetas->execute();     

        if ($cadastrarmetas->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro ao cadastrar meta !" . $e->getMessage();
    }
}
