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

            /* PEGAR FOTO PARA CADASTRAR NOVA FOTO */
            $temp = $_FILES['novaFoto']['tmp_name'];

            /* ARRAY PARA PEGAR AS FOTOS */
            $fotosCadastradas = array("fotos" => $fotoInicio, "detalhes" => $fotoDetalhes);
            foreach ($fotosCadastradas as $k => $v):

                if (file_exists("../../" . $v)):
                    unlink("../../" . $v);
                    $fotos = WideImage::load($temp);
                    if ($k == 'fotos'):
                        $redimensionar = $fotos->resize(105, 80, "fill");
                        $redimensionar->saveToFile("../../$k/" . $novoNome);
                    elseif ($k == 'detalhes'):
                        $redimensionar = $fotos->resize(270, 210, "fill");
                        $redimensionar->saveToFile("../../$k/" . $novoNome);
                    endif;

                else:
                    $fotos = WideImage::load($temp);
                    if ($k == 'fotos'):
                        $redimensionar = $fotos->resize(105, 80, "fill");
                        $redimensionar->saveToFile("../../$k/" . $novoNome);
                    elseif ($k == 'detalhes'):
                        $redimensionar = $fotos->resize(270, 210, "fill");
                        $redimensionar->saveToFile("../../$k/" . $novoNome);
                    endif;

                endif;

            endforeach;
           
            /*CADASTRAR A FOTO NO BANCO DE DADOS*/
            if (alterarFoto($novoNome, $id)):
                $mensagem = "Foto cadastrada com sucesso !";
            else:
                $erro = "Erro ao alterar a foto !";
            endif;

        else:
            $erro = $obrigatorio;
        endif; //obrigatorio
    else:
        $erro = "Não foi possível pegar o ID da pizza";
    endif; //isset postid

endif; //se clicou no botao alterar
?>

<div class="formularioAlterar">

    <h2>:.CADASTRAR FOTO DA PIZZA.:</h2>  

    <?php
    $listarPizzas = listar("pizzas", $parametros = ' INNER JOIN categorias ON pizzas.pizza_categoria = categorias.categoria_id');
    ?>

    <table width="1000">

        <tr class="cabecalho">
            <td width="130">Nome</td>
            <td width="130">Categoria</td>
            <td width="80">Foto</td>
            <td width="300">Foto Alterar</td>
            <td width="30">Alterar</td>
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