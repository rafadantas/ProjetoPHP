<?php

function alterarPizza(Array $dadosPizza) {

	$pdo = conectar();
	try {
			
		$alterarPizza = $pdo -> prepare("UPDATE pizzas SET pizza_nome = :nome, pizza_categoria = :categoria, pizza_preco = :preco, pizza_descricao = :descricao WHERE pizza_id = :id");
		foreach ($dadosPizza as $k => $value) :
			$alterarPizza -> bindValue(":$k", $value);		
		endforeach;
		$alterarPizza -> execute();

		if ($alterarPizza -> rowCount() == 1) :
			return true;
		else :
			return false;
		endif;
	} catch (PDOException $e) {
		echo "Erro: " . $e -> getMessage();
	}
}