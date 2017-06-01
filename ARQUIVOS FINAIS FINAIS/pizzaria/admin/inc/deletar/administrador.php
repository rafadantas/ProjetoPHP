<?php
if (isset($_GET['id'])) :
	try {
		if (filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) :
			$id = $_GET['id'];

			if (deletar($id, 'administrador', 'administrador_id')) :
				$mensagem = "Administrador deletado com sucesso !";
			else :
				$erro = "Erro ao deletar administrador";
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
$admin = listar('administrador');

if(!empty($admin)):

$params = array(
'mode' => 'Jumping',
'perPage' => 10,
'delta' => 5,
'itemData' => $admin);

$pager = & Pager::factory($params);
$data = $pager->getPageData();

foreach($data as $a):
		?>
		<tr>
			<td align="center"><?php echo $a['administrador_nome']; ?></td>
			<td align="center"><a href="?p=deletar_administrador&id=<?php echo $a['administrador_id'] ?>"><img src="../images/delete.gif" /></a></td>

		</tr>

		<?php
		endforeach;
		else:
		?>
		<td colspan="3" align="center">Nenhum cliente cadastrada</td>
		<?php endif; ?>
		<tr>
			<td colspan="4" align="center"><?php
			$links = $pager -> getLinks();
			echo $links['all'];
			?></td>
		</tr>
	</table>
	<?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
	<?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?>
</div>