<!--<?php
//include_once "functions/conexao/conexao.php";
//include_once "functions/metas/metas.php";

?>-->

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"/>
		<meta name="description" content="<?php echo exibeMetas(1);?>"/>
		<meta name="keywords" content="<?php echo exibeMetas(2);?>"/>
		<title>O Senhor das Pizzas</title>
		<link href="../css/style.css" rel="stylesheet" type="text/css" media="screen" /> 
	</head>
	<body>
		
		<div id="container">
		
			<header id="header">
				<section id="busca">
					<form action="" method="POST">
						
						<input type="text" name="buscar_pizza" value="buscar..." id="txt_busca" />
						<select name="categorias" id="select_busca">
							<option selected="selected">Escolha uma categoria</option>
						</select>
						<input type="submit" name="buscar_pizza_categoria" value="Ok" id="bt_busca">

					</form>					
				</section>
				
			</header>

			<nav id="menu">
				<ul>
					<li><a href="../index.php">Home</a></li>
					<li><a href="empresa.php">A Empresa</a></li>
					<li><a href="meuspedidos.php">Meus Pedidos</a></li>
					<li><a href="cadastro.php">Cadastro</a></li>
					<li><a href="contato.php">Contato</a></li>
					<li><a href="pizzas.php">Pizzas</a></li>
					<li><a href="login.php">Login</a></li>
				</ul>
			</nav>

			
			
			<div id="mensagem_logado">
				Seja bem vindo visitante.				
			</div>
			<main id="conteudo">
				<section class="conteudo" >
			    	<div class="texto2" >
			        	<h1><b>Cadastro</b></h1>            
			        	<p><form action="action_page.php">
			  			Nome:<br>
			  			<input type="text" name="nome" value="">
			  			<br>
			  			sobrenome:<br>
			  			<input type="text" name="sobrenome" value="">
			 			<br>
			  			<form action="action_page.php">
			  			email<br>
			  			<input type="text" name="email" value="">
			  			<br>
			  			senha<br>
			  			<input type="text" name="senha" value="">
			  			<br><br>
						</form>
			  			<input type="submit" value="Enviar">
						</form></p>
			   		</div>           
              	</section>
			</main>

			

			<footer id="footer">
				O Senhor das Pizzas 2017 - Todos os direitos reservados
			</footer>
			
		</div><!--final do container-->
		
	</body>
</html>