<?php
include_once "../functions/conexao/conexao.php";
include_once "../functions/helpers/utils.php";

$busca = $_POST['busca'];

$dados = listarBusca('pizzas', 'pizza_nome', $busca);

if (empty($dados)) :
	echo "Nenhuma pizza encontrada !";
else :
?>

<table width="900" cellspacing="0" id="tabela">
	<thead>
		<tr>
			<td>Foto:</td>
			<td>Nome:</td>
			<td>Preço</td>
			<td>Ação:</td>
		</tr>
	</thead>
	<tbody>
<?php 
$c = new ArrayIterator($dados);
while($c->valid()):
	$d = $c->current();
  ?>	
		<tr>
			<td><img src="<?php echo "../../".$d['pizza_foto_inicio'] ?>" /></td>
			<td><?php echo $d['pizza_nome']; ?> </td>
			<td><?php echo $d['pizza_preco']; ?> </td>
			<td><a class="linkPizza" href="?p=alterar_pizza">Alterar</a> |<a class="linkPizza" href="?p=deletar_pizza&id=<?php echo $d['pizza_id']; ?>"> Deletar</a></td>
		</tr>		
<?php
$c -> next();
endwhile;
 ?>
	</tbody>
</table>

<?php endif;