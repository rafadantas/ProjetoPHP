<?php

function alterarFoto($foto, $id){
      $pdo = conectar();
    try {
        $alterarFoto = $pdo->prepare("UPDATE pizzas SET pizza_foto_inicio = :fotoInicio, pizza_foto_detalhes = :fotoDetalhes
                                      WHERE pizza_id = :id");       
        $alterarFoto->bindValue(":fotoInicio", "fotos/".$foto);
        $alterarFoto->bindValue(":fotoDetalhes", "detalhes/".$foto);
        $alterarFoto->bindValue(":id", $id);
        $alterarFoto->execute();
        
        echo $alterarFoto->rowCount()."<br />";
        
        if ($alterarFoto->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
