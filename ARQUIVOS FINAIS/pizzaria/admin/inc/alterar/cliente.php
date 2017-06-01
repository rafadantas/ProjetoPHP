<?php
if (isset($_POST['alterarCliente'])):

    $nomeCliente = obrigatorio("nome", $_POST['cliNome']);
    $estadoCliente = obrigatorio("estado", $_POST['cliEstado']);
    $cidadeCliente = obrigatorio("cidade", $_POST['cliCidade']);
    $bairroCliente = obrigatorio("bairro", $_POST['cliBairro']);
    $cepCliente = obrigatorio("cep", $_POST['cliCep']);
    $telefoneCliente = obrigatorio("telefone", $_POST['cliTelefone']);
    $celularCliente = obrigatorio("celular", $_POST['cliCelular']);
    $enderecoCliente = obrigatorio("endereco", $_POST['cliEndereco']);
    $loginCliente = obrigatorio("login", $_POST['cliLogin']);
    $senhaCliente = obrigatorio("senha", $_POST['cliSenha']);
    $nascimentoCliente = obrigatorio("nascimento", $_POST['cliNascimento']);
    
    global $obrigatorio;

    if (!isset($obrigatorio)):

        $id = $_POST['ClienteId'];

        if (verificaCadastroAlterar('clientes', 'cliente_nome', $nomeCliente, 'cliente_id', $id)):

            if (verificaCadastroAlterar('clientes', 'cliente_login', $loginCliente, 'cliente_id', $id)):

                if (verificaCadastroAlterar('clientes', 'cliente_senha', $senhaCliente, 'cliente_id', $id)):

                    $dadosCliente = pegarPeloId('clientes', 'cliente_id', $id);
                    $senhaDoBanco = $dadosCliente['cliente_senha'];

                    if ($senhaDoBanco === $senhaCliente):
                        $senha = $senhaDoBanco;
                    else:
                        $senha = md5($senhaCliente);
                    endif;

                    /* ALTERAR O CLIENTE */
                    if (alterarCliente($dadosCliente = array(
                                "nome" => $nomeCliente,
                                "cidade" => $cidadeCliente,
                                "estado" => $estadoCliente,
                                "bairro" => $bairroCliente,
                                "cep" => $cepCliente,
                                "telefone" => $telefoneCliente,
                                "celular" => $celularCliente,
                                "endereco" => $enderecoCliente,
                                "nascimento" => $nascimentoCliente,
                                "login" => $loginCliente,
                                "senha" => $senha,
                                "id" => $id
                            ))):
                        $mensagem = "Dados do cliente alterado com sucesso !";
                    else:
                        $erro = "Ocorreu um erro ao alterar os dados do cliente, ou você não alterou nenhum dado do formulário !";
                    endif;


                else:
                    $erro = "Já existe uma senha cadastrada com esse nome: " . "<b>" . $senhaCliente . "</b>";
                endif;
            else:

                $erro = "Já existe um login cadastrado com esse nome: " . "<b>" . $loginCliente . "</b>";

            endif;
        else:
            $erro = "Já existe um cliente cadastrado com esse nome: " . "<b>" . $nomeCliente . "</b>";
        endif;

    else:

        $erro = $obrigatorio;

    endif;

endif;
?>

<div class="formularioAlterar">

    <h2>:.ALTERAR CLIENTE.:</h2>  

    <?php
    $dadosAdministrador = listar("clientes");
    ?>

    <table>

        <tr class="cabecalho">
            <td>Nome</td>
            <td>Cidade</td>
            <td>Estado</td>
            <td>Bairro</td>
            <td>Cep</td>
            <td>Telefone</td>
            <td>Celular</td>
            <td>Endereço</td>
            <td>Nascimento</td>
            <td>Login</td>
            <td>Senha</td>
            <td>Alterar</td>
        </tr>
        <?php
        $params = array(
            'mode' => 'Jumping',
            'perPage' => 10,
            'delta' => 5,
            'itemData' => $dadosAdministrador);

        $pager = & Pager::factory($params);
        $data = $pager->getPageData();

        foreach ($data as $d):
            ?>
            <form action="" method="POST">
                <tr>
                <input type="hidden" name="id" value="<?php echo $d['cliente_id']; ?>" />
                <td><input type="text" value="<?php echo $d['cliente_nome']; ?>" name="cliNome" class="txt_field" /></td>
                <td><input type="text" value="<?php echo $d['cliente_cidade']; ?>" name="cliCidade" class="txt_field" /></td>
                <td><input type="text" value="<?php echo $d['cliente_estado']; ?>" name="cliEstado" class="txt_field_menor" /></td>
                <td><input type="text" value="<?php echo $d['cliente_bairro']; ?>" name="cliBairro" class="txt_field" /></td>
                <td><input type="text" value="<?php echo $d['cliente_cep']; ?>" name="cliCep" class="txt_field" /></td>
                <td><input type="text" value="<?php echo $d['cliente_telefone']; ?>" name="cliTelefone" class="txt_field" /></td>
                <td><input type="text" value="<?php echo $d['cliente_celular']; ?>" name="cliCelular" class="txt_field" /></td>
                <td><input type="text" value="<?php echo $d['cliente_endereco']; ?>" name="cliEndereco" class="txt_field" /></td>
                <td><input type="text" value="<?php echo $d['cliente_nascimento']; ?>" name="cliNascimento" class="txt_field_maior" /></td>
                <td><input type="text" value="<?php echo $d['cliente_login']; ?>" name="cliLogin" class="txt_field_menor" /></td>
                <input type="hidden" name="ClienteId" value="<?php echo $d['cliente_id']; ?>" />
                <td><input type="text" value="<?php echo $d['cliente_senha']; ?>" name="cliSenha" class="txt_field_menor" /></td>            
                <td><input type="submit" name="alterarCliente" value="alterar" class="input_button" /></td>        
                </tr>
            </form>
        <?php endforeach; ?>

        <tr>
            <td colspan="4" align="center">
                <?php
                $links = $pager->getLinks();
                echo $links['all'];
                ?>
            </td>
        </tr>

        <tr>
            <td colspan="11" align="center">    
                <?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
                <?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?>
            </td>
        </tr>

    </table>
</div>