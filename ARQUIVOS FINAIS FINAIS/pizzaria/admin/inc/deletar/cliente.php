<?php
if (isset($_GET['id'])) :
	try {
		if (filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) :
			$id = $_GET['id'];

			if (deletar($id, 'clientes', 'cliente_id')) :
				$mensagem = "Cliente deletado com sucesso !";
			else :
				$erro = "Erro ao deletar cliente";
			endif;
		else :
			throw new Exception("O numero passado pela url deve ser inteiro");
		endif;
	} catch(Exception $e) {
		echo "Erro: " . $e -> getMessage();
		exit ;
	}
endif;
?>

<div class="formularioDeletar">

	<h2>:.DELETAR CLIENTE.:</h2>

	<table width="900">

		<tr class="cabecalho">
			<td>Nome:</td>
			<td>Cidade:</td>
			<td>Deletar:</td>
		</tr>

		<?php
$clientes = listar('clientes');

if(!empty($clientes)):

foreach($clientes as $c):
		?>
		<tr>
			<td align="center"><?php echo $c['cliente_nome']; ?></td>
			<td align="center"><?php echo $c['cliente_cidade']; ?></td>
			<td align="center"><a href="?p=deletar_cliente&id=<?php echo $c['cliente_id'] ?>"><img src="../images/delete.gif" /></a></td>

		</tr>

		<?php
		endforeach;
		else:
		?>
		<td colspan="3" align="center">Nenhum cliente cadastrada</td>
		<?php endif; ?>
	</table>
	<?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
	<?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?>
</div>