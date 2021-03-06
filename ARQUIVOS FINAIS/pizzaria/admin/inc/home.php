<div id="pedidos">
    <h2>Pedidos de Hoje</h2>

    <table width="1000" cellspacing="0" id="tabela_pedidos">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Pizza</th>
                <th>Preço</th>
                <th>Qtd</th>   
                <th>Subtotal</th> 
                <th>Data Pedido</th>
                <th>Dados Cliente</th>
                <th>Status Pedido</th>
                <th>Tipo entrega</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            $hoje = date('Y-m-d');
            //pegar id do cliente para listar pedidos do mesmo
            $listar = listar("pedidos", " inner join pizzas inner join clientes on pedidos.pedidos_pizza = pizzas.pizza_id and pedidos.pedidos_cliente = clientes.cliente_id WHERE pedidos_data >= '$hoje' ORDER BY pedidos.pedidos_data DESC");
            if (!empty($listar)):

                /* FAZ A PAGINACAO */
                $params = array(
                    'mode' => 'Sliding',
                    'perPage' => 20,
                    'delta' => 2,
                    'itemData' => $listar
                );
                $pager = & Pager::factory($params);
                $data = $pager->getPageData();

                /* FAZ A LISTAGEM DOS PEDIDOS */
                $d = new ArrayIterator($data);
                $total = 0;
                while ($d->valid()):
                    $dados = $d->current();
                    if (date('Y-m-d', strtotime($dados['pedidos_data'])) == date('Y-m-d')):
                        $css = 'hoje';
                    else:
                        $css = 'nao_hoje';
                    endif;
                    $total += ($dados['pedidos_qtd'] * $dados['pizza_preco']);
                    ?>
                    <tr class="<?php echo $css; ?>">
                        <td><?php echo $dados['cliente_nome'] ?></td>
                        <td><?php echo $dados['pizza_nome'] ?></td>
                        <td>R$ <?php echo number_format($dados['pizza_preco'], 2, ",", "."); ?></td>
                        <td align="center"><?php echo $dados['pedidos_qtd']; ?></td>
                        <td>R$ <?php echo number_format(($dados['pedidos_qtd'] * $dados['pizza_preco']), 2, ",", "."); ?></td>
                        <td align="left"><?php echo date('d/m/Y H:i:s', strtotime($dados['pedidos_data'])); ?></td>                 
                        <td align="center">
                            <a href="?p=dados_cliente&id=<?php echo $dados['cliente_id']; ?>">
                            <img src="../images/dados.png" title="ver dados do cliente"></img>
                            </a>
                        </td>
                        <td align="center">
                            <a href="#" id="bt_status" data-id="<?php echo $dados['pedidos_id']; ?>" data-pedido ="<?php echo $dados['pedidos_data']; ?>" data-status="<?php echo $dados['pedidos_status'] ?>">
                                <?php echo ($dados['pedidos_status'] == 'pendente') ? '<img src="../images/pendente.png" alt="entregar a pizza na casa do cliente" title="pizza ainda não foi entregue"></img>' : '<img src="../images/entregue.png" alt="entregar a pizza na casa do cliente" title="pizza ja foi entregue"></img>'; ?>
                            </a>
                        </td>
                        <td align="center">
                            <?php echo ($dados['pedidos_tipo_pagamento'] == 1) ? '<img src="../images/entregar.png" alt="entregar a pizza na casa do cliente" title="entregar a pizza"></img>' : '<img src="../images/buscar.png" alt="cliente buscar a pizza" title="cliente vai buscar a pizza"></img>'; ?>
                        </td>                      
                    </tr>

                    <?php
                    $d->next();
                endwhile;
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <td coslpan="9" id="total">TOTAL DE VENDAS HOJE: R$ <?php echo number_format($total, 2, ",", "."); ?></td>    
                </tr>
                <tr>
                    <td colspan="5" align="center">
                        <?php
                        $links = $pager->getLinks();
                        echo $links['all'];

                    else:
                        echo '<tr>';
                        echo '<td colspan="9" align="center">';
                        echo "Nenhum pedido ainda foi feito hoje !";
                        echo '</td>';
                        echo '</tr>';

                    endif;
                    ?>
                </td>
            </tr>
            <tr>
                <td id="update" colspan="9" aling="center"></td>
            </tr>
        </tfoot>
    </table>

</div>