<?php
//CLICOU EM ALTERAR PIZZA
if (isset($_POST['alterarPizza'])) :

	$nomePizza = obrigatorio("nome", $_POST['nome_pizza']);
	$categoriaPizza = obrigatorio("categoria", $_POST['categoria_pizza']);
	$precoPizza = obrigatorio("preço", $_POST['preco_pizza']);
	$descircaoPizza = obrigatorio("descricao", $_POST['descricao_pizza']);
	$idPizza = (int)$_POST['id'];
	global $obrigatorio;

	if (!isset($obrigatorio)) :

		$dadosPizza = array("nome" => $_POST['nome_pizza'], 
		"categoria" => $_POST['categoria_pizza'], 
		"preco" => $_POST['preco_pizza'], 
		"descricao" => $_POST['descricao_pizza'], 
		"id"=>$idPizza);

		if (alterarPizza($dadosPizza)) :
			$mensagem = "Pizza alterada com sucesso !";
		else :
			$erro = "Erro ao alterar Pizza !";
		endif;

	endif;

endif;
?>

<div class="formularioAlterar">

	<h2>:.ALTERAR DADOS PIZZA.:</h2>

	<?php
	$listarPizzas = listar("pizzas", $parametros = ' INNER JOIN categorias ON pizzas.pizza_categoria = categorias.categoria_id');
	?>

	<table width="900">

		<tr class="cabecalho">
			<td >Nome</td>
			<td>Categoria</td>
			<td>Preço</td>
			<td>Descrição</td>
			<td>Alterar</td>
		</tr>
		<?php
$params = array(
'mode' => 'Jumping',
'perPage' => 10,
'delta' => 5,
'itemData' => $listarPizzas);

$pager = & Pager::factory($params);
$data = $pager->getPageData();

foreach ($data as $d):
		?>
		<form action="" method="POST">
			<input type="hidden" name="id" value="<?php echo $d['pizza_id']; ?>" />
			<tr>
				<td>
				<input type="text" name="nome_pizza" value="<?php echo $d['pizza_nome']; ?>" class="txt_field">
				</td>
				<td><?php
				//FAZ A LISTAGEM DAS CATEGORIAS
				$cat = listar('categorias');
				?>

				<select name="categoria_pizza" class="select_field">
					<?php
foreach($cat as $c):
					?>
					<option value="<?php echo $c['categoria_id'] ?>" <?php echo $c['categoria_nome'] == $d['categoria_nome'] ? "selected = 'selected'" : $c['categoria_nome']; ?>><?php echo $c['categoria_nome']; ?></option>

					<?php
					endforeach;
					?>
				</select></td>
				<td>
				<input type="text" name="preco_pizza" value="<?php echo $d['pizza_preco']; ?>" class="txt_field">
				</td>
				<td>				<textarea name="descricao_pizza">
						<?php echo $d['pizza_descricao']; ?>
					</textarea></td>
				<td>
				<input type="submit" name="alterarPizza" value="alterar" class="input_button" />
				</td>
				<td align="center"></td>
			</tr>
		</form>
		<?php endforeach; ?>

		<tr>
			<td colspan="4" align="center"><?php
			$links = $pager -> getLinks();
			echo $links['all'];
			?></td>
		</tr>

		<tr>
			<td colspan="5" align="center"><?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
			<?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?></td>
		</tr>

	</table>

</div>
