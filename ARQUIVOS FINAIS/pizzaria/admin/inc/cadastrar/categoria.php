<?php
unset($_SESSION);

if (isset($_POST['cadastrarCategoria'])):

    $categoria = obrigatorio("categoria", addslashes($_POST['categoria']));

    criaSessao("categoria", $categoria);

    global $obrigatorio;

    if (empty($obrigatorio)):

        if (verificaCadastro("categorias", "categoria_nome", $categoria)):

            if (cadastrarCategoria($categoria)):
                $mensagem = "Categoria cadastrada com sucesso !";
            else:
                $erro = "Erro ao cadastrar categoria !";
            endif;
        else:
            $erro = "Essa categoria ja existe !";
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

    <h2>:.CADASTRAR CATEGORIA.:</h2>

    <div class="form">
        <form action="" method="POST">
            <label for="categoria"></label>
            <input type="text" name="categoria" value="<?php echo isset($_SESSION['categoria']) ? $_SESSION['categoria']: "";  ?>" class="txt_field"></input> *
            <label for="submit"></label>
            <input type="submit" name="cadastrarCategoria" value="cadastrar" class="bt_sumbmit"></input>
            <input type="submit" name="limparCampos" value="limpar formulário" class="bt_sumbmit"></input>
        </form>
    </div>

    <?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
    <?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?>

    <div class="obrigatorio">* campos obrigatórios</div>


</div>