<div id="buscaPizza">

    <h2>Resultados da busca</h2>

    <?php
    if (isset($_POST['buscar_pizza']) || isset($_GET['pageID']) > 0):
        $categoria = obrigatorio('categoria', isset($_POST['categoria']) ? $_POST['categoria'] : $_SESSION['categoriaPizza']);
        $pizza = obrigatorio('pizza', isset($_POST['pizza']) ? $_POST['pizza'] : $_SESSION['nomePizza']);

        $_SESSION['categoriaPizza'] = $categoria;
        $_SESSION['nomePizza'] = $pizza;

        global $obrigatorio;

        if (!isset($obrigatorio)):
            $resultado = buscarPizza($_SESSION['categoriaPizza'], $_SESSION['nomePizza']);
            if (!empty($resultado)):
                //LISTA RESULTADOS

                /* FAZ A PAGINACAO */
                $params = array(
                    'mode' => 'Sliding',
                    'perPage' => 12,
                    'delta' => 2,
                    'itemData' => $resultado
                );
                $pager = & Pager::factory($params);
                $data = $pager->getPageData();

                $d = new ArrayIterator($data);
                while ($d->valid()):
                    ?>    
                    <div class="listarPizzas">
                        <a href="http://localhost/pizzaria/detalhes/<?php echo strtolower(urlencode($d->current()->pizza_nome)); ?>"><img src='<?php echo $d->current()->pizza_foto_inicio; ?>' >
                            <span class="nomePizza"><?php echo $d->current()->pizza_nome; ?></span><br />
                            <span class="nomePizza"><?php echo "R$ " . number_format($d->current()->pizza_preco, 2, ",", "."); ?></span>
                        </a>
                    </div>
                    <?php
                    $d->next();
                endwhile;
                ?> 

                <div class="paginacao">
                    <?php
                    $links = $pager->getLinks();
                    echo $links['all'];
                    ?>
                </div>

                <?php
            else:
                echo "Nenhum resultado encontrado para a busca $pizza";
            endif;
        else:
            echo $obrigatorio;
        endif;
    else:
        echo "Você tem que digitar uma busca !";
    endif;
    ?>


</div>