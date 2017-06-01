<?php
function alterarMetas($texto, $id) {
    $pdo = conectar();
    try {

        $alterarMeta = $pdo->prepare("UPDATE metas SET meta_texto = :texto WHERE meta_id = :id");     
        $alterarMeta->bindValue(":texto",$texto);
        $alterarMeta->bindValue(":id",$id);
        $alterarMeta->execute();
        
        if ($alterarMeta->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
