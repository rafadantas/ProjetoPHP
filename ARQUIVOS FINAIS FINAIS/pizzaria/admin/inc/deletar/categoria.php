<?php
if (isset($_GET['id'])) :
	try {
		if (filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) :
			$id = $_GET['id'];

			$idPizza = pegarPeloId('pizzas', 'pizza_categoria', $id);

			if (empty($idPizza)) :
				$erro = "Nehuma pizza cadastrada para essa categoria !";
			else :

				$foto = pegarPeloId('pizzas', 'pizza_id', $idPizza['pizza_id']);
				$fotosPastas = array();

				if (empty($foto)) :
					$erro = "Pizza ja deletada !";
				else :

					if (deletarFoto($foto['pizza_foto_inicio'], $foto['pizza_foto_detalhes'], '../../fotos/')) :
						if (deletar($idPizza['pizza_id'], 'pizzas', 'pizza_id')) :
							if (deletar($id, 'categorias', 'categoria_id')) :
								$mensagem = "Categoria deletada com sucesso !";
							else :
								$erro = "Erro ao deletar categoria !";
							endif;
						else :
							$erro = "Erro ao deletar pizza";
						endif;
					else :
						$erro = "Erro ao deletar as fotos !";
					endif;
				endif;

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
			<td>Deletar:</td>
		</tr>

		<?php
$categorias = listar('categorias');

if(!empty($categorias)):

foreach($categorias as $c):
		?>
		<tr>
			<td align="center"><?php echo $c['categoria_nome']; ?></td>
			<td align="center"><a href="?p=deletar_categoria&id=<?php echo $c['categoria_id'] ?>"><img src="../images/delete.gif" /></a></td>

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