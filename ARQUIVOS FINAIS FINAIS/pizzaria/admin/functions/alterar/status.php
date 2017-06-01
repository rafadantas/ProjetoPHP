<?php

function alterarStatus($status, $id, $data) {

    $pdo = conectar();
    try {
        $atualizar = $pdo->prepare("UPDATE pedidos SET pedidos_status = :status, pedidos_data = :data WHERE pedidos_id = :id");
        $atualizar->bindValue(":status", $status);
        $atualizar->bindValue(":data", $data);
        $atualizar->bindValue(":id", $id);
        $atualizar->execute();

        if ($atualizar->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro " . $e->getMessage();
    }
}