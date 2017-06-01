<?php
if (isset($_POST['update_metas'])):

    $texto = obrigatorio("texto", $_POST['texto']);

    global $obrigatorio;

    if (!isset($obrigatorio)):
        $id = $_POST['id'];

        if (alterarMetas(trim($texto), $id)):
            $mensagem = "Meta atualizado com suceso !";
        else:
            $erro = "Erro ao atualizar meta, tente novamente !";
        endif;

    else:
        $erro = $obrigatorio;
    endif;



endif;
?>
<div class="formularioAlterar">

    <h2>:.ALTERAR METAS.:</h2>  


    <table width="800">
        <tr>
        <form action="" method="POST">   
            <td>Descriptions</td>

            <td align="center">

                <?php $dadosMetas = pegarPeloId('metas', 'meta_tipo', 1); ?>
                <input type="hidden" name="id" value="<?php echo $dadosMetas['meta_id']; ?>" />
                <textarea name="texto">
                    <?php echo $dadosMetas['meta_texto']; ?>
                </textarea>
            </td>
            <td>
                <input type="submit" name="update_metas" value="atualizar" class="input_button" />
            </td>
        </form>
        </tr>


        <tr>
        <form action="" method="POST">  
            <td>keywords</td>
            <td align="center">
                <?php $dadosMetas = pegarPeloId('metas', 'meta_tipo', 2); ?>
                <input type="hidden" name="id" value="<?php echo $dadosMetas['meta_id']; ?>" />
                <textarea name="texto">
                    <?php echo $dadosMetas['meta_texto']; ?>
                </textarea>
            </td>
            <td>
                <input type="submit" name="update_metas" value="atualizar" class="input_button" />
            </td>
        </form>
        </tr>

        <tr>
            <td colspan="3" align="center">    
                <?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
                <?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?>
            </td>
        </tr>

    </table>

</div>