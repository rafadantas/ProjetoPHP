<?php

function verificaCadastro($tabela, $nomeCampo, $cadastro) {

	$pdo = conectar();
	try {

		$verificaCadastro = $pdo -> prepare("SELECT * FROM $tabela WHERE $nomeCampo = :cadastro");
		$verificaCadastro -> bindValue(":cadastro", $cadastro);
		$verificaCadastro -> execute();

		if ($verificaCadastro -> rowCount() == 1) :
			return false;
		else :
			return true;
		endif;
	} catch (PDOException $e) {
		echo "Erro ao verificar registro cadastrado " . $e -> getMessage();
	}
}

function verificaCadastroAlterar($tabela, $nomeCampo, $cadastro, $campoId, $id) {

	$pdo = conectar();
	try {

		$verificaCadastro = $pdo -> prepare("SELECT * FROM $tabela WHERE $nomeCampo = :cadastro 
                                           AND " . $campoId . " != :id");
		$verificaCadastro -> bindValue(":cadastro", $cadastro);
		$verificaCadastro -> bindValue(":id", $id);
		$verificaCadastro -> execute();

		if ($verificaCadastro -> rowCount() == 1) :
			return false;
		else :
			return true;
		endif;
	} catch (PDOException $e) {
		echo "Erro ao verificar registro cadastrado " . $e -> getMessage();
	}
}

function obrigatorio($nomeCampo, $campo = null) {

	global $obrigatorio;

	if ($campo !== null) :
		if (empty($campo)) :
			$obrigatorio = "O campo $nomeCampo é obrigatório !";
		else :
			return $campo;
		endif;
	endif;
}

function validarCep($cep) {

	global $validou;

	if (preg_match("/^\d{5}-\d{3}$/i", $cep)) :
		return true;
	else :
		$validou = "O formato do cep, não foi aceito !";
	endif;
}

function validarTelefone($telefone) {
	global $validou;

	if (preg_match("/^[(]\d{2}[)]\d{4}-\d{4}$/i", $telefone)) :
		return true;
	else :
		$validou = "O formato do telefone ou celular, não foi aceito !";
	endif;
}

function criaSessao($sessao, $valorSessao) {

	if (empty($valorSessao)) :
		return $_SESSION[$sessao] = "";
	else :
		return $_SESSION[$sessao] = $valorSessao;
	endif;
}

function listar($tabela, $parametros = null) {

	$pdo = conectar();
	try {

		if (is_null($parametros)) :
			$listar = $pdo -> prepare("SELECT * FROM " . $tabela);
		else :
			$listar = $pdo -> prepare("SELECT * FROM " . $tabela . $parametros);
		endif;
		$listar -> execute();

		if ($listar -> rowCount() > 0) :
			$dados = $listar -> fetchAll(PDO::FETCH_ASSOC);
			return $dados;
		else :
			return false;
		endif;
	} catch (PDOException $e) {
		echo "Erro: " . $e -> getMessage();
	}
}

function pegarPeloId($tabela, $campoTabela, $id) {
	$pdo = conectar();
	try {

		$listarDados = $pdo -> prepare("SELECT * FROM " . $tabela . " WHERE " . $campoTabela . " = " . $id);
		$listarDados -> execute();

		if ($listarDados -> rowCount() > 0) :
			$dados = $listarDados -> fetch(PDO::FETCH_ASSOC);
			return $dados;
		else :
			return false;
		endif;
	} catch (PDOException $e) {
		echo "Erro: " . $e -> getMessage();
	}
}

function deletar($id, $tabela, $campoTabela) {
	$pdo = conectar();
	try {
		$deletar = $pdo -> prepare("DELETE FROM $tabela WHERE $campoTabela = :id");
		$deletar -> bindValue(":id", $id);
		$deletar -> execute();

		if ($deletar -> rowCount() == 1) :
			return true;
		else :
			return false;
		endif;

	} catch (PDOException $e) {
		echo "Erro: " . $e -> getMessage();
	}
}

function deletarFoto($fotoInicial, $fotoDetalhes, $dir) {
	
	global $erro;

	$fotoInicio = explode("/", $fotoInicial);
	$fotoD = explode("/", $fotoDetalhes);

	$d = new DirectoryIterator($dir);
	while ($d -> valid()) :
		if ($d -> isFile()) :
			$fotosPastas[] = $d -> getFilename();
		endif;
		$d -> next();
	endwhile;

	if (in_array($fotoInicio[1], $fotosPastas) AND in_array($fotoD[1], $fotosPastas)) :
		if (unlink("../../fotos/" . $fotoInicio[1])) :
			if (unlink("../../detalhes/" . $fotoD[1])) :
				return true;			
			else :
				return false;
			endif;
		else :
			$erro = "Erro ao deletar a foto inicial";
		endif;
	else :
		$erro = "A foto não existe mais, cadastre outra e tente novamente !";
	endif;
}

function listarBusca($tabela,$campoBusca, $busca){
	$pdo = conectar();
	try {

		$listarBusca = $pdo -> prepare("SELECT * FROM $tabela  WHERE $campoBusca LIKE :b" );
		$listarBusca->bindValue(":b", $busca.'%');
		$listarBusca -> execute();

		if ($listarBusca -> rowCount() > 0) :
			$dados = $listarBusca -> fetchAll(PDO::FETCH_ASSOC);
			return $dados;
		else :
			return false;
		endif;
	} catch (PDOException $e) {
		echo "Erro: " . $e -> getMessage();
	}
}
