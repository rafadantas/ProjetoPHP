<?php
include "../../../functions/conexao/conexao.php";

$pdo = conectar();
$tipo = $_POST['escolhido'];

switch ($tipo):
    case "description":
        $meta = 1;
		break;
    case "keywords":
        $meta = 2;
		break;
endswitch;

try {
    $verificarCadastro = $pdo->prepare("SELECT * FROM metas INNER JOIN metas_tipo 
                                        ON metas.meta_tipo = metas_tipo.metas_tipo_id WHERE metas_tipo = :tipo");
    $verificarCadastro->bindValue(":tipo", $tipo);
    $verificarCadastro->execute();

    if ($verificarCadastro->rowCount() == 1):
        echo "Já existe uma meta para esse campo !";
    else:
        ?>
        <script type="text/javascript" src="http://localhost/pizzaria/admin/js/tiny.js"></script>
        <form action="" method="POST">
            <textarea name="metas"></textarea>
            <input type="hidden" name="meta" value="<?php echo $meta; ?>" />
            <input type="submit" name="cadastrarMeta" value="cadastrar" class="bt_sumbmit">
        </form>

    <?php
    endif;
} catch (PDOException $e) {
    echo "Erro ao verificar cadastro das metas " . $e->getMessage();
}


