<?php
if (isset($_GET['id'])) :
	try {
		if (filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) :

			//PEGAR FOTO PELO ID
			$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
			$foto = pegarPeloId('pizzas', 'pizza_id', $id);
			$fotosPastas = array();

			if (empty($foto)) :
				$erro = "Pizza ja deletada !";
			else :

				$fotoInicial = $foto['pizza_foto_inicio'];
				$fotoInicio = explode("/", $fotoInicial);

				$fotoDetalhes = $foto['pizza_foto_detalhes'];
				$fotoD = explode("/", $fotoDetalhes);

				$dir="../../fotos";
				
					$d = new DirectoryIterator($dir);
					while ($d -> valid()) :
						if ($d -> isFile()) :						
							$fotosPastas[] = $d->getFilename();
						endif;
						$d -> next();
					endwhile;	

						if (in_array($fotoInicio[1], $fotosPastas) AND in_array($fotoD[1], $fotosPastas)):							
								 if (unlink("../../fotos/" . $fotoInicio[1])) :
									if (unlink("../../detalhes/" . $fotoD[1])) :
										//DELETAR REGISTRO NO BANCO

										if (deletar($id, 'pizzas', 'pizza_id')) :
											$mensagem = "Pizza deletada com sucesso !";
										else :
											$erro = "Erro ao deletar a pizza !";
										endif;
									else :
										$erro = "Erro ao deletar a foto detalhes";
									endif;
								else :
									$erro = "Erro ao deletar a foto inicial";
								endif;
							else :
								$erro = "A foto não existe mais, cadastre outra e tente novamente !";
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

  <h2>:.DELETAR FOTO PIZZA.:</h2>  

	<table width="900">

		<tr class="cabecalho">
			<td>Foto</td>
			<td>Nome:</td>
			<td>Deletar:</td>
		</tr>

		<?php
$pizzas = listar('pizzas');

if(!empty($pizzas)):

foreach($pizzas as $p):
		?>
		<tr>
			<td align="center"><img src="<?php echo "../../" . $p['pizza_foto_inicio']; ?>" /></td>

			<td><?php echo $p['pizza_nome']; ?></td>
			<td align="center"><a href="?p=deletar_pizza&id=<?php echo $p['pizza_id'] ?>"><img src="../images/delete.gif" /></a></td>

		</tr>

		<?php
		endforeach;
		else:
		?>
		<td colspan="3" align="center">Nenhuma pizza cadastrada</td>
		<?php endif; ?>
	</table>
	<?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
	<?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?>
</div>