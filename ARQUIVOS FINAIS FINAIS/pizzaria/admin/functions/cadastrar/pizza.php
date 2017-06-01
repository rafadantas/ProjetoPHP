<?php

function cadastrarPizza(Array $dadosPizza) {
    
    $pdo = conectar();
    try {
      
        $cadastrarPizza = $pdo->prepare("INSERT INTO pizzas(pizza_categoria, pizza_nome,pizza_preco, pizza_descricao,
                                              pizza_foto_inicio, pizza_foto_detalhes)
                                             VALUES(:categoria, :nome,:preco,:descricao, :fotoInicio, :fotoDetalhes)");
       foreach($dadosPizza as $k=>$v):
           $cadastrarPizza->bindValue(":$k", $v);
       endforeach;
        
        $cadastrarPizza->execute();

        if ($cadastrarPizza->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro ao cadastrar pizza !" . $e->getMessage();
    }
}
