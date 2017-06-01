<?php

function logarCliente($login, $senha) {
	$pdo = conectar();
	try {
		$logarCliente = $pdo -> prepare('SELECT * FROM clientes WHERE cliente_login = :login AND cliente_senha = :senha');
		$logarCliente -> bindValue(':login', $login);
		$logarCliente -> bindValue(':senha', $senha);
		$logarCliente -> execute();
		
		if($logarCliente->rowCount() == 1):
			$dados = $logarCliente->fetch(PDO::FETCH_ASSOC);
			$_SESSION['logado_cliente'] = true;
			$_SESSION['nome_cliente'] 	= $dados['cliente_nome'];
			$_SESSION['id_cliente'] 	= $dados['cliente_id'];
		else:
			throw new Exception("Erro ao logar, usuário ou senha inválidos !");		
		endif;	
		
		
	} catch(PDOException $e) {
		echo 'Erro: ' . $e -> getMessage();
	}
}

function logOut(){
	if(isset($_SESSION['logado_cliente'])):
		session_destroy();
		header('location: http://localhost/pizzaria/');
	endif;	
}
