<!--BOTAO SAIR QUE APARECE AO CLICAR EM ALTERAR DADOS CLIENTE-->
<div id="sairAlterar"><img src="../images/delete.png" id='botaoSair' width="16" height="16" /></div>
<!--BOTAO SAIR QUE APARECE AO CLICAR EM ALTERAR DADOS CLIENTE-->

<?php 
/*INCLUDES DOS ARQUIVOS NECESSARIOS PARA MOSTRAR OS DADOS DO CLIENTE*/
include_once "../functions/conexao/conexao.php";
include_once "../functions/helpers/utils.php";
/*INCLUDES DOS ARQUIVOS NECESSARIOS PARA MOSTRAR OS DADOS DO CLIENTE*/
?>

<!--CHAMADA DO JQUERY PARA FECHAR OS DADOS DO CLIENTE-->
 <script type="text/javascript" src="http://localhost/pizzaria/js/jquery.js"></script>
 <script type="text/javascript" src="http://localhost/pizzaria/js/alterarDadosCliente.js"></script>
<!--CHAMADA DO JQUERY PARA FECHAR OS DADOS DO CLIENTE-->

<?php
/*LISTAGEM DOS DADOS DO CLIENTE*/
 $dadosCliente = pegarPeloId('clientes', 'cliente_id', $_POST['id']);
 $d = new ArrayIterator($dadosCliente);	
?>
<form action="" method="post" id='formularioCadastro'>
	<label for="nome">Nome:</label>
	<input type="text" name="nome" value="<?php echo $d['cliente_nome'];  ?>" class="txt" id="nome">
	</input>
	* <label for="cidade">Cidade:</label>
	<input type="hidden" name="id" value="<?php echo $d['cliente_id'];  ?>" />
	<input type="text" name="cidade" class="txt" value="<?php echo $d['cliente_cidade'];  ?>" id="cidade">
	</input>
	* <label for="estado">Estado:</label>
	<input type="text" name="estado" class="txt" value="<?php echo $d['cliente_estado'];  ?>" id="estado">
	</input>
	* <label for="bairro">Bairro:</label>
	<input type="text" name="bairro"class="txt" value="<?php echo $d['cliente_bairro'];  ?>" id="bairro">
	</input>
	* <label for="cep">Cep:</label>
	<input type="text" name="cep" class="txt" value="<?php echo $d['cliente_cep'];  ?>" id="cep">
	</input>
	* <label for="telefone">Telefone:</label>
	<input type="text" name="telefone" class="txt" value="<?php echo $d['cliente_telefone'];  ?>" id="telefone">
	</input>
	* <label for="celular">Celular:</label>
	<input type="text" name="celular" class="txt" value="<?php echo $d['cliente_celular'];  ?>" id="celular">
	</input>
	* <label for="email">E-mail:</label>
	<input type="text" name="email" class="txt" value="<?php echo $d['cliente_email'];  ?>" id="email">
	</input>
	* <label for="endereco">Endereço:</label>
	<input type="text" name="endereco" class="txt" value="<?php echo $d['cliente_endereco'];  ?>" id="endereco">
	</input>
	* <label for="nascimento">Nascimento(dd/mm/YYYY):</label>
	<input type="text" name="nascimento" class="txt" value="<?php echo $d['cliente_nascimento'];  ?>" id="nascimento">
	</input>
	* <label for="login">Login:</label>
	<input type="text" name="login" class="txt" value="<?php echo $d['cliente_login'];  ?>" id="login">
	</input>
	* <label for="senha">Senha:</label>
	<input type="text" name="senha" class="txt" value="<?php echo $d['cliente_senha'];  ?>" id="senha">
	</input>
	* <label for="submit"></label>
	<input type="submit" name="cadastrarCliente" value="cadastrar" class="bt_sumbmit">
	</input>
</form>