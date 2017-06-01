<?php

function exibeMetas($tipo){
	$pdo = conectar();

	try{
		$listarMetas = $pdo->prepare("SELECT * FROM metas WHERE meta_tipo = :tipo");
		$listarMetas->bindValue(":tipo", $tipo);
		$listarMetas->execute();
		$dados = $listarMetas->fetch(PDO::FETCH_ASSOC);
		return $dados['meta_texto'];
	}catch(PDOException $e){
		echo "Erro ao listar metas ".$e->getMessage();
	}


}