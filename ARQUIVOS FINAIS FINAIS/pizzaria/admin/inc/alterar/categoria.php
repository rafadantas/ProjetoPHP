<?php
if (isset($_POST['alterarCategoria'])):

    $nomecategoria = obrigatorio("categoria", $_POST['categoriaNome']);
    $id = (int) $_POST['id'];
    global $obrigatorio;

    if (empty($obrigatorio)):
        if (verificaCadastroAlterar("categorias", "categoria_nome", $nomecategoria, "categoria_id", $_POST['id'])):
            if (alterarcategoria($nomecategoria, $id)):
                $mensagem = "";
                $mensagem = "Categoria alterada com sucesso !";
            else:
                $erro = "Não foi possível fazer a alteração da categoria";
            endif;
        else:
            $erro = "Já existe uma categoria com esse nome !";
        endif;

    else:
        $erro = $obrigatorio;
    endif;



endif;
?>

<div class="formularioAlterar">

    <h2>:.ALTERAR CATEGORIA.:</h2>  

    <?php $dadosAdministrador = listar("categorias"); ?>

    <table >

        <tr class="cabecalho">
            <td>Nome</td>
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
                <input type="hidden" name="id" value="<?php echo $d['categoria_id']; ?>" />
                <td><input type="text" value="<?php echo $d['categoria_nome']; ?>" name="categoriaNome" class="txt_field" /></td>
                <td><input type="submit" name="alterarCategoria" value="alterar" class="input_button" /></td>
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
            <td colspan="4" align="center">    
                <?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
                <?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?>
            </td>
        </tr>

    </table>
</div>