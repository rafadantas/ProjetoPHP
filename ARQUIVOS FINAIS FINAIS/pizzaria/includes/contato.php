<?php
require_once 'bibliotecas/PHPmailer/class.phpmailer.php';
require_once 'bibliotecas/PHPmailer/class.smtp.php';

if (isset($_POST['enviarContato'])) :

    $nome = obrigatorio('nome', $_POST['nome']);
    $email = obrigatorio('semail', $_POST['email']);
    $telefone = obrigatorio('telefone', $_POST['telefone']);
    $cidade = obrigatorio('cidade', $_POST['cidade']);
    $assunto = obrigatorio('assunto', $_POST['assunto']);
    $mensagem = obrigatorio('mensagem', $_POST['mensagem']);

    if (!isset($obrigatorio)) :
        /* ENVIAR EMAIL */
        if (enviarEmail($nome, $email, $assunto, $telefone, $mensagem, $cidade)) :
            $sucesso = "E-mail enviado com sucesso !";
        else :
            $erro = 'Erro ao enviar email';
        endif;
    else :
        $erro = $obrigatorio;

    endif;

endif;
?>
<div id="contato">
    <h1>CONTATO</h1>
    <form action="" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" class="txt">
        </input>
        * <label for="email">E-mail:</label>
        <input type="text" name="email" class="txt">
        </input>
        * <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" class="txt" >
        </input>
        * <label for="Cidade">Cidade:</label>
        <input type="text" name="cidade"class="txt" >
        </input>
        * <label for="assunto">Assunto:</label>
        <input type="text" name="assunto" class="txt">
        </input>
        * <label for="mensagem">Mensagem:</label>
        <textarea name="mensagem" id="mensagem"></textarea>		
        </input>
        * <label for="submit"></label>
        <input type="submit" name="enviarContato" value="enviar" class="bt_sumbmit">
        </input>
        <input type="submit" name="limparCampos" value="limpar formulário" id="limpar" class="bt_sumbmit">
        </input>
    </form>
    <?php echo isset($erro) ? '<div id="erro">' . $erro . '</div>' : ''; ?>
    <?php echo isset($sucesso) ? '<div id="sucesso">' . $sucesso . '</div>' : ''; ?>
</div>