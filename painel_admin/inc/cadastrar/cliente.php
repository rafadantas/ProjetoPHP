<?php
unset($_SESSION);

if (isset($_POST['cadastrarCliente'])):

    $nome = obrigatorio("nome", addslashes($_POST['nome']));
    $cidade = obrigatorio("cidade", addslashes($_POST['cidade']));
    $estado = obrigatorio("estado", addslashes($_POST['estado']));
    $bairro = obrigatorio("bairro", addslashes($_POST['bairro']));
    $cep = obrigatorio("cep", addslashes($_POST['cep']));
    validarCep($cep);
    $telefone = obrigatorio("telefone", addslashes($_POST['telefone']));
    validarTelefone($telefone);
    $celular = obrigatorio("celular", addslashes($_POST['celular']));
    validarTelefone($celular);
    $endereco = obrigatorio("endereco", addslashes($_POST['endereco']));
    $login = obrigatorio("login", addslashes($_POST['login']));
    $senha = obrigatorio("senha", addslashes($_POST['senha']));

    criaSessao("nome", $nome);
    criaSessao("cidade", $cidade);
    criaSessao("estado", $estado);
    criaSessao("bairro", $bairro);
    criaSessao("cep", $cep);
    criaSessao("telefone", $telefone);
    criaSessao("celular", $celular);
    criaSessao("endereco", $endereco);
    criaSessao("login", $login);
    criaSessao("senha", $senha);
    
    
    global $validou;
    global $obrigatorio;


    if (empty($obrigatorio)):
        if (empty($validou)):

            if (verificaCadastro("clientes", "cliente_nome", $nome)):
                if (verificaCadastro("clientes", "cliente_login", $login)):
                    if (cadastrarCliente(array("nome" => $nome,"cidade"=>$cidade, "estado"=>$estado,"bairro"=>$bairro,
                                                "cep"=>$cep, "telefone"=>$telefone, "celular"=>$celular,
                                                 "endereco"=>$endereco,"login"=>$login, "senha"=>$senha))):
                        $mensagem = "Cliente cadastrado com sucesso !";
                    else:
                        $erro = "Erro ao cadastrar cliente !";
                    endif;
                else:
                    $erro = "Esse login ja existe !";
                endif;
            else:
                $erro = "Esse cliente ja existe !";
            endif;

        else://empty validoucep
            $erro = $validou;
        endif; //empty validoucep
    else://empty obrigatorio
        $erro = $obrigatorio;
    endif; //empty obrigatorio

endif;


/*PARA LIMPAR  FRMULARIO*/
if(isset($_POST['limparCampos'])):
  unset($_SESSION);
endif;
?>

<div class="formularioCadastro">

    <h2>:.CADASTRAR CLIENTE.:</h2>

    <div class="formCadastro">
        <form action="" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo isset($_SESSION['nome']) ? $_SESSION['nome']: "";  ?>" class="txt_field"></input> *
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" value="<?php echo isset($_SESSION['cidade']) ? $_SESSION['cidade']: "";  ?>" class="txt_field"></input> *
            <label for="estado">Estado:</label>
            <input type="text" name="estado" value="<?php echo isset($_SESSION['estado']) ? $_SESSION['estado']: "";  ?>" class="txt_field_menor"></input> *
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" value="<?php echo isset($_SESSION['bairro']) ? $_SESSION['bairro']: "";  ?>" class="txt_field"></input> *
            <label for="cep">Cep:</label>
            <input type="text" name="cep" value="<?php echo isset($_SESSION['cep']) ? $_SESSION['cep']: "";  ?>" class="txt_field_menor"></input> *
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" value="<?php echo isset($_SESSION['telefone']) ? $_SESSION['telefone']: "";  ?>" class="txt_field_menor"></input> *
            <label for="celular">Celular:</label>
            <input type="text" name="celular" value="<?php echo isset($_SESSION['celular']) ? $_SESSION['celular']: "";  ?>" class="txt_field_menor"></input> *
            <label for="endereco">Endereço:</label>     
            <input type="text" name="endereco" value="<?php echo isset($_SESSION['esndereco']) ? $_SESSION['endereco']: "";  ?>" class="txt_field_maior"></input> *
            <label for="login">Login:</label>     
            <input type="text" name="login" value="<?php echo isset($_SESSION['login']) ? $_SESSION['login']: "";  ?>" class="txt_field"></input> *
            <label for="senha">Senha:</label>     
            <input type="text" name="senha" value="<?php echo isset($_SESSION['senha']) ? $_SESSION['senha']: "";  ?>" class="txt_field"></input> *
            <label for="submit"></label>
            <input type="submit" name="cadastrarCliente" value="cadastrar" class="bt_sumbmit"></input>
            <input type="submit" name="limparCampos" value="limpar formulário" class="bt_sumbmit"></input>
        </form>
    </div>

    <?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
    <?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?>


    <div class="obrigatorio">* campos obrigatórios</div>

</div>