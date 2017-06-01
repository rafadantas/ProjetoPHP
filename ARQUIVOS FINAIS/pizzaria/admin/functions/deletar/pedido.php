<?php

function deletarPedido($id) {
    $pdo = conectar();
    try {
        $deletar = $pdo->prepare('DELETE FROM pedidos WHERE pedidos_id = :id');
        $deletar->bindValue(':id', $id);
        $deletar->execute();
        if ($deletar->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}