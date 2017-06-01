<div id="destaques_semana">
    <h1>Destaques da Semana</h1>
    <div id='coin-slider'>
    <?php
    $dados = listar('pizzas', ' order by pizza_id DESC LIMIT 4');
    $d = new ArrayIterator($dados);
    while ($d->valid()):
        ?>          
            <a href="http://localhost/pizzaria/detalhes/<?php echo strtolower(urlencode($d -> current() -> pizza_nome)); ?>" target="_blank">
                <img src='<?php echo $d -> current() -> pizza_foto_detalhes; ?>' >
                <span><?php echo $d -> current() -> pizza_nome; ?></span>
            </a>   
        <?php
		$d -> next();
		endwhile;
    ?>    
 </div>
 
</div><!--DESTAQUES SEMANA-->

<div id="pizzas_amostra">
<h1>Pizzas Mil grau do momento</h1>
 <?php
    $dados = listar('pizzas', ' order by rand() DESC LIMIT 8');
    $d = new ArrayIterator($dados);
    while ($d->valid()):
        ?>    
    <div class="pizzas">
        <a href="http://localhost/pizzaria/detalhes/<?php echo strtolower(urlencode($d -> current() -> pizza_nome)); ?>"><img src='<?php echo $d -> current() -> pizza_foto_inicio; ?>' >
                <span class="nomePizza"><?php echo $d -> current() -> pizza_nome; ?></span><br />
         		  <span class="nomePizza"><?php echo "R$ ".number_format($d -> current() -> pizza_preco,2,",","."); ?></span>
         </a>
    </div>
        <?php
		$d -> next();
		endwhile;
    ?>    


</div><!--PIZZAS AMOSTRA-->