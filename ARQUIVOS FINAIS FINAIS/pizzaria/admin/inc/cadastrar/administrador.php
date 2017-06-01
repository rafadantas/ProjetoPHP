<?php
unset($_SESSION);

if (isset($_POST['cadastrarAdministrador'])):
    $nome = obrigatorio("nome", addslashes($_POST['nome']));
    $login = obrigatorio("login", addslashes($_POST['login']));
    $senha = obrigatorio("senha", addslashes($_POST['senha']));

    criaSessao("nomeAdmin", $nome);
    criaSessao("loginAdmin", $login);
    criaSessao("senhaAdmin", $senha);

    global $obrigatorio;

    if (empty($obrigatorio)):
        if (verificaCadastro("administrador", "administrador_nome", $nome)):
            if (verificaCadastro("administrador", "administrador_login", $login)):
                if (cadastrarAdministrador(array("nome" => $nome, "login" => $login, "senha" => md5($senha)))):
                    $mensagem = "Administrador cadastrado com sucesso !";
                else:
                    $erro = "Erro ao cadastrar administrador !";
                endif;
            else:
                $erro = "Esse login ja existe !";
            endif;
        else:
            $erro = "Esse administrador ja existe !";
        endif;
    else:
        $erro = $obrigatorio;
    endif;
endif;

/*PARA LIMPAR  FRMULARIO*/
if(isset($_POST['limparCampos'])):
  unset($_SESSION);
endif;
?>

<div class="formularioCadastro">

    <h2>:.CADASTRAR ADMINISTRADOR.:</h2>

    <div class="formCadastro">
        <form action="" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo isset($_SESSION['nomeAdmin']) ? $_SESSION['nomeAdmin'] : ""; ?>" class="txt_field"></input> *
            <label for="login">Login:</label>
            <input type="text" name="login" value="<?php echo isset($_SESSION['loginAdmin']) ? $_SESSION['loginAdmin'] : ""; ?>" class="txt_field"></input> *
            <label for="senha">Senha:</label>
            <input type="text" name="senha" value="<?php echo isset($_SESSION['senhaAdmin']) ? $_SESSION['senhaAdmin'] : ""; ?>" class="txt_field"></input> *
            <label for="submit"></label>
            <input type="submit" name="cadastrarAdministrador" value="cadastrar" class="bt_sumbmit"></input>
            <input type="submit" name="limparCampos" value="limpar formulário" class="bt_sumbmit"></input>
        </form>
    </div>

    <?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
    <?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?>


    <div class="obrigatorio">* campos obrigatórios</div>

</div>