<?php
if (isset($_POST['pedir'])) :

	if (isset($_SESSION['nome_cliente'])) :

		$qtd = obrigatorio('quantidade', trim($_POST['qtd']));
		$id = $_POST['id'];
		$pizza = $_POST['pizza'];

		global $obrigatorio;

		if (!isset($obrigatorio)) :

			if (!isset($_SESSION['pedido'])) :
				$_SESSION['pedido'] = array();
			endif;

			if (empty($_SESSION['pedido'][$pizza])) :
				$_SESSION['pedido'][$pizza] = $qtd;
			else :
				if (!empty($qtd)) :
					$_SESSION['pedido'][$pizza] += $qtd;
				else :
					$_SESSION['pedido'][$pizza] += 1;
				endif;
			endif;
		else :
			$erro = $obrigatorio;
		endif;
	else :
		$erro = "Você tem que estar logado para fazer o pedido !";
	endif;
endif;
?>
<div id="detalhes">
    <?php
    if (isset($_GET['p'])):

        $explodeUrl = explode('/', $_GET['p']);
        $pizza = $explodeUrl[1];
        $pizzaEscolhida = pegarPeloId('pizzas', 'pizza_nome', $pizza);
        ?>
        <h1><?php echo $pizzaEscolhida['pizza_nome']; ?></h1>
        <div id="fotoPizzaDetalhes">
            <img src="../<?php echo $pizzaEscolhida['pizza_foto_detalhes']; ?>" title="<?php echo $pizzaEscolhida['pizza_nome']; ?>" />
        </div>
        <div id="detalhesPizza">
            <?php echo $pizzaEscolhida['pizza_descricao']; ?><br />
             <?php echo "R$ " . number_format($pizzaEscolhida['pizza_preco'], 2, ",", "."); ?>
        </div>
        
        <div id="add_pedido">
        	<!--PEGAR ID DO CLIENTE-->
        	<?php
			if (isset($_SESSION['nome_cliente'])) :
				$id = pegarPeloId('clientes', 'cliente_nome', $_SESSION['nome_cliente']);
			endif;
        	?>
        	<!--PEGAR ID DO CLIENTE-->
        	<form action="" method="post">
        		<label for="quantidade">Quantidade:</label>
        		<input type="hidden" name="id" value="<?php echo isset($_SESSION['nome_cliente']) ? $id['cliente_id'] : ''; ?>" />
        		<input type="hidden" name="pizza" value="<?php echo $pizzaEscolhida['pizza_id']; ?>" />
        		<input type="text" name="qtd" value="1" id="txt_qtd" />
        		<input type="submit" name="pedir" value="adicionar pedido" />
        	</form>  
        	
        	 <?php echo isset($erro) ? '<div id="erroPedido">' . $erro . '</div>' : ''; ?>
    
    		<p>
    			Pedidos dessa pizza:
    			<?php echo !empty($_SESSION['pedido'][$pizzaEscolhida['pizza_id']]) ? $_SESSION['pedido'][$pizzaEscolhida['pizza_id']] : 0; ?>
    		</p>
    
        </div>
        
           
        <?php
		else:
		include_once 'includes/404.php';
		endif;
    ?>
</div>