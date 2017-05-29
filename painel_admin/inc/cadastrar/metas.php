<?php
if (isset($_POST['cadastrarMeta'])):

    if (verificaCadastro("metas", "meta_tipo", $_POST['meta'])):
        if (cadastrarMetas($_POST['meta'], $_POST['metas'])) :
            $mensagem = "";
            $mensagem = "Meta cadastrada com sucesso !";
        else:
            $erro = "Erro ao cadastrar metas !";
        endif;
    else:
        $erro = "Ja existe uma meta cadastrada !";
    endif;
endif;
?>
<div class="formularioCadastro">

    <h2>CADASTRAR META TAGS</h2>  
    <p> Escolha qual metatag você quer cadastrar:</p>

    <div id="metas">
        <form action="" method="POST">
            <label for="description">Description</label>
            <input type="radio" name="meta" value="description"></input>

            <label for="keyowords">Keywords</label>
            <input type="radio" name="meta" value="keywords"></input>
        </form>
    </div>

    <div id="resposta"></div>

    <?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
    <?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?>
</div>