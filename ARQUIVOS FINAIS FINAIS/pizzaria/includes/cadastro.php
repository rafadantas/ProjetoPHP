<?php
if (isset($_POST['cadastrarCliente'])) :

    $nome = obrigatorio('nome', $_POST['nome']);
    $cidade = obrigatorio('cidade', $_POST['cidade']);
    $estado = obrigatorio('estado', $_POST['estado']);
    $bairro = obrigatorio('bairro', $_POST['bairro']);
    $cep = obrigatorio('bairro', $_POST['cep']);
    $telefone = obrigatorio('telefone', $_POST['telefone']);
    $celular = obrigatorio('celular', $_POST['celular']);
    $email = obrigatorio('email', $_POST['email']);
    $endereco = obrigatorio('endereco', $_POST['endereco']);
    $nascimento = obrigatorio('nascimento', $_POST['nascimento']);
    $login = obrigatorio('login', $_POST['login']);
    $senha = obrigatorio('senha', $_POST['senha']);

    if (!isset($obrigatorio)) :

        /* TRANSFORMA DATA DE NASCIMENTO */
        $data = explode('/', $nascimento);
        $dataNascimento = $data[2] . "-" . $data[1] . "-" . $data[0];
        /* TRANSFORMA DATA DE NASCIMENTO */
      
        if (verificaCadastro('clientes', 'cliente_nome', $nome)) :
            if (verificaCadastro('clientes', 'cliente_login', $login)) :
                $dados = array("nome" => $nome, "cidade" => $cidade, "estado" => $estado, "bairro" => $bairro, "cep" => $cep, "telefone" => $telefone, "celular" => $celular, "email" => $email, "nascimento" => $dataNascimento, "endereco" => $endereco, "login" => $login, "senha" => $senha);

                if (cadastrarCliente($dados)) :
                    $sucesso = "Cliente cadastrado com sucesso !";
                else :
                    $erro = "Não foi possível cadastrar o cliente !";
                endif;
            else :
                $erro = "Já existe um cliente com esse login";
            endif;
        else :
            $erro = "Já existe um cliente com esse nome !";
        endif;
    else :
        $erro = $obrigatorio;
    endif;
endif;
?>
<div id="cadastro">
    <h1>CADASTRO DE CLIENTE</h1>
    <form action="" method="post" id='formularioCadastro'>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" class="txt" id="nome">
        </input>
        * <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" class="txt" id="cidade">
        </input>
        * <label for="estado">Estado:</label>
        <input type="text" name="estado" class="txt" id="estado">
        </input>
        * <label for="bairro">Bairro:</label>
        <input type="text" name="bairro"class="txt" id="bairro">
        </input>
        * <label for="cep">Cep:</label>
        <input type="text" name="cep" class="txt" id="cep">
        </input>
        * <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" class="txt" id="telefone">
        </input>
        * <label for="celular">Celular:</label>
        <input type="text" name="celular" class="txt" id="celular">
        </input>
        * <label for="email">E-mail:</label>
        <input type="text" name="email" class="txt" id="email">
        </input>
        * <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" class="txt" id="endereco">
        </input>
        * <label for="nascimento">Nascimento(dd/mm/YYYY):</label>
        <input type="text" name="nascimento" class="txt" id="nascimento">
        </input>
        * <label for="login">Login:</label>
        <input type="text" name="login" class="txt" id="login">
        </input>
        * <label for="senha">Senha:</label>
        <input type="text" name="senha" class="txt" id="senha">
        </input>
        * <label for="submit"></label>
        <input type="submit" name="cadastrarCliente" value="cadastrar" class="bt_sumbmit">
        </input>
        <input type="button" value="limpar formulário" id="limpar" class="bt_sumbmit">
        </input>
    </form>
    <div>
        <?php echo isset($erro) ? '<div id="erro">' . $erro . '</div>' : ''; ?>
        <?php echo isset($sucesso) ? '<div id="sucesso">' . $sucesso . '</div>' : ''; ?>
    </div>
</div>