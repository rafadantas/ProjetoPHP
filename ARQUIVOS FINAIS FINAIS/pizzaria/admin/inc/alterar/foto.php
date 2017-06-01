<?php
require_once "../Bibliotecas/lib/WideImage.php";
if (isset($_POST['alterarFoto'])):

    if (isset($_POST['id'])):

        $id = (int) $_POST['id'];
        $foto = obrigatorio("foto", $_FILES['novaFoto']['name']);
        global $obrigatorio;

        if (!isset($obrigatorio)):

            $id = (int) $_POST['id'];
            $dados = pegarPeloId('pizzas', 'pizza_id', $id);

            $fotoInicio = $dados['pizza_foto_inicio'];
            $fotoDetalhes = $dados['pizza_foto_detalhes'];

            /* RENOMEAR FOTO */
            $extensao = end(explode(".", $foto));
            $novoNome = uniqid() . "." . $extensao;

            try {
                if (is_file("../../" . $fotoInicio)):
                    if (is_file("../../" . $fotoDetalhes)):
                        if (unlink("../../" . $fotoInicio)):
                            if (unlink("../../" . $fotoDetalhes)):

                                /* PEGAR FOTO PARA UPDATE */
                                $temp = $_FILES['novaFoto']['tmp_name'];

                                /* UPLOAD DA FOTO */
                                try {
                                    $fotos = WideImage::load($temp);
                                    $redimensionar = $fotos->resize(105, 80, "fill");
                                    $redimensionar->saveToFile("../../fotos/" . $novoNome);

                                    if ($redimensionar->isValid()):
                                        $redimensionarFotoDetalhes = $fotos->resize(270, 210, "fill");
                                        $redimensionarFotoDetalhes->saveToFile("../../detalhes/" . $novoNome);
                                        if ($redimensionarFotoDetalhes->isValid()):
                                            /* ALTERAR FOTO NO BANCO */

                                            if (alterarFoto($novoNome, $id)):
                                                $mensagem = "Foto alterada com sucesso !";
                                            else:
                                                $erro = "Erro ao alterar a foto !";
                                            endif;
                                        else:
                                            throw new WideImage_Exception("Erro ao fazer o upload da foto detalhes");
                                        endif;
                                    else:
                                        throw new WideImage_Exception("Erro ao fazer o upload da foto Inicial");
                                    endif;
                                } catch (WideImage_Exception $e) {
                                    echo "Erro " . $e->getMessage();
                                }
                            else:
                                throw new Exception("Erro ao deletar foto inicial !");
                            endif;
                        else:
                            throw new Exception("Erro ao deletar foto detalhes !");
                        endif;
                    else:
                        throw new Exception("A foto detalhes não existe mais !");
                    endif;
                else:
                    throw new Exception("A foto inicial não existe mais !");
                endif;
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
                die;
            }
        else:
            $erro = $obrigatorio;
        endif; //obrigatorio
    else:
        $erro = "Não foi possível pegar o ID da pizza";
    endif; //isset postid

endif; //se clicou no botao alterar
?>

<div class="formularioAlterar">

    <h2>:.ALTERAR FOTO DA PIZZA.:</h2>  

    <?php
    $listarPizzas = listar("pizzas", $parametros = ' INNER JOIN categorias ON pizzas.pizza_categoria = categorias.categoria_id');
    ?>

    <table width="800">

        <tr class="cabecalho">
            <td width="110">Nome</td>
            <td width="110">Categoria</td>
            <td width="80">Foto</td>
            <td width="270">Foto Alterar</td>
            <td width="80">Alterar</td>
        </tr>
        <?php
        $params = array(
            'mode' => 'Jumping',
            'perPage' => 10,
            'delta' => 5,
            'itemData' => $listarPizzas);

        $pager = & Pager::factory($params);
        $data = $pager->getPageData();

        foreach ($data as $d):
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <tr>
                <input type="hidden" name="id" value="<?php echo $d['pizza_id']; ?>" />
                <td><?php echo $d['pizza_nome']; ?></td>
                <td><?php echo $d['categoria_nome']; ?></td>
                <td align="center"><img src="<?php echo "../../" . $d['pizza_foto_inicio'] ?>" /></td>
                <td><input type="file" name="novaFoto" class="txt_field" /></td>
                <td><input type="submit" name="alterarFoto" value="alterar" class="input_button" /></td>
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
            <td colspan="5" align="center">    
                <?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
                <?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?>
            </td>
        </tr>

    </table>
</div>