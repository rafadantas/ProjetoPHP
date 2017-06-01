<div id="pizzasCadastradas">
    <h2>Pizzas Cadastradas</h2>
    <?php
    $dados = listar('pizzas', ' order by rand()');

    /* FAZ A PAGINACAO */
    $params = array(
        'mode' => 'Sliding',
        'perPage' => 12,
        'delta' => 2,
        'itemData' => $dados
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

</div>