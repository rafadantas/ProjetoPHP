<?php
unset($_SESSION);
require_once "../Bibliotecas/lib/WideImage.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['cadastrarPizza'])):

    $categoriaPizza = obrigatorio("categoria", $_POST['categoria']);
    $nomePizza = obrigatorio("nome", $_POST['nome']);
    $precoPizza = obrigatorio("preço", $_POST['preco']);
    $fotoPizza = obrigatorio("foto", $_FILES['foto_pizza']['name']);
    $descricaoPizza = obrigatorio("descricao", $_POST['descricao']);

    criaSessao("nomePizza", $nomePizza);
    criaSessao("precoPizza", $precoPizza);
    criaSessao("descricaoPizza", $descricaoPizza);

    global $obrigatorio;

    if (empty($obrigatorio)):
        $temp = $_FILES['foto_pizza']['tmp_name'];

        /* RENOMEAR FOTO */
        $extensao = end(explode(".", $fotoPizza));
        $novoNome = uniqid() . "." . $extensao;

        try {
            $fotos = WideImage::load($temp);
            $redimensionar = $fotos->resize(105, 80, "fill");
            $redimensionar->saveToFile("../../fotos/" . $novoNome);

            if ($redimensionar->isValid()):
                $redimensionar = $fotos->resize(270, 210, "fill");
                $redimensionar->saveToFile("../../detalhes/" . $novoNome);

                if (verificaCadastro("pizzas", "pizza_nome", $_POST['nome'])):

                    if (cadastrarPizza($dadosPizza = array(
                                "categoria" => $categoriaPizza,
                                "nome" => $nomePizza,
                                "preco" => $precoPizza,
                                "descricao" => $descricaoPizza,
                                "fotoInicio" => "fotos/" . $novoNome,
                                "fotoDetalhes" => "detalhes/" . $novoNome
                            ))):
                        $mensagem = "";
                        $mensagem = "Pizza cadastrada com sucesso !";
                    else:
                        $erro = "Erro ao cadastrar Pizza !";
                    endif;

                else:

                    $erro = "Ja existe uma pizza cadastrada com esse nome !";
                endif;


            else:
                throw new Exception("Não foi possível redimensionar a foto");
            endif;
        } catch (WideImage_InvalidImageSourceException $e) {
            echo "Erro: " . $e->getMessage();
        }
    else:
        $erro = $obrigatorio;
    endif;

endif;

/* PARA LIMPAR  FRMULARIO */
if (isset($_POST['limparCampos'])):
    unset($_SESSION);
endif;
?>
<div class="formularioCadastro">

    <h2>:.CADASTRAR PIZZA.:</h2>
    <div class="formCadastro">
        <form action="" method="POST" enctype="multipart/form-data">


            <label for="categoria">Categoria:</label>
            <select name="categoria">               
                <?php
                $dados = listar("categorias");
                if ($dados):
                    ?>
                    <option value="" selected="selected">Escolha uma categoria</option>
                    <?php
                    foreach ($dados as $d):
                        ?>
                        <option value="<?php echo $d['categoria_id']; ?>"><?php echo $d['categoria_nome']; ?></option>
                        <?php
                    endforeach;
                else:
                    ?>
                    <option value="" selected="selected">Nenhuma categoria cadastrada</option>
                <?php
                endif;
                ?>
            </select>

            <label for="nome">Nome da Pizza:</label>
            <input type="text" name="nome" value="<?php echo isset($_SESSION['nomePizza']) ? $_SESSION['nomePizza'] : ""; ?>" class="txt_field" />

            <label for="preco">Preço da Pizza:</label>
            <input type="text" name="preco" value="<?php echo isset($_SESSION['precoPizza']) ? $_SESSION['precoPizza'] : ""; ?>" class="txt_field" />

            <label for="nome">Foto da Pizza:</label>
            <input type="file" name="foto_pizza" class="txt_field" />

            <label for="descricao"></label>
            <textarea name="descricao">
                <?php echo isset($_SESSION['descricaoPizza']) ? $_SESSION['descricaoPizza'] : ""; ?>
            </textarea>

            <input type="submit" name="cadastrarPizza" value="cadastrar" class="bt_sumbmit"></input>
            <input type="submit" name="limparCampos" value="limpar formulário" class="bt_sumbmit"></input>


        </form>
    </div>

    <?php echo isset($mensagem) ? '<div class="mensagem">' . $mensagem . '</div>' : ""; ?>
    <?php echo isset($erro) ? '<div class="erro">' . $erro . '</div>' : ""; ?>

</div>