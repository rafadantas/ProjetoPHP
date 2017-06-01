<div id='areaCliente'>



    
    <?php
    if (isset($_POST['cadastrarCliente'])):
//ALTERAR DADOS DO CLIENTE
        $nome = obrigatorio('nome', $_POST['nome']);
        $cidade = obrigatorio('cidade', $_POST['cidade']);
        $estado = obrigatorio('estado', $_POST['estado']);
        $bairro = obrigatorio('bairro', $_POST['bairro']);
        $cep = obrigatorio('bairro', $_POST['cep']);
        $telefone = obrigatorio('telefone', $_POST['telefone']);
        $celular = obrigatorio('celular', $_POST['celular']);
        $email = obrigatorio('email', $_POST['email']);
        $endereco = obrigatorio('endereco', $_POST['endereco']);
        $nascimento = obrigatorio('nascimento', $_POST['nascimento']);
        $login = obrigatorio('login', $_POST['login']);
        $senha = obrigatorio('senha', $_POST['senha']);
        $id = $_POST['id'];

        if (!isset($obrigatorio)):

            $dados = array(
                "nome" => $nome,
                "cidade" => $cidade,
                "estado" => $estado,
                "bairro" => $bairro,
                "cep" => $cep,
                "telefone" => $telefone,
                "celular" => $celular,
                "endereco" => $endereco,
                "nascimento" => $nascimento,
                "login" => $login,
                "senha" => $senha,
                "id" => $id
            );
            if (alterarCliente($dados)):
                $sucesso = "Dados alterados !";
            else:
                $erro = 'Erro ao alterar dados, tente novamente, se presistir o problema entre em contato
			 com a pizzaria !';
            endif;

        else:
            $erro = $obrigatorio;
        endif;
    endif;

//DELETAR PIZZAS E PEDIDOS
    if (substr_count($_GET['p'], '/') > 0):
        $pagina = explode('/', $_GET['p']);
        if ($pagina[2] == 'pedido'):
            if (!empty($_SESSION['pedido'])):
                unset($_SESSION['pedido']);
            else:
                echo "Nao existe nenhum pedido !";
            endif;
        elseif ($pagina[2] == 'pizza'):
            $id = filter_var($pagina[3], FILTER_SANITIZE_NUMBER_INT);
            $idDaPizza = filter_var($id, FILTER_VALIDATE_INT);
            if ($idDaPizza):
                unset($_SESSION['pedido'][$idDaPizza]);
            else:
                $erro = "Essa pizza não existe ou não foi adicionada ao pedido !";
            endif;
        endif;
    endif;


    /* VERIFICA SE CLIENTE ESTA LOGADO */
    if (isset($_SESSION['logado_cliente'])) :
        ?>


        <!--ALTERAR DADOS DO CLIENTE-->
        <div id="laterarDadosCliente">
            <h2>Alterar Dados:</h2>
            <a href="#" id="alterar" name="<?php echo $_SESSION['id_cliente']; ?>">Alterar meus Dados</a>
        </div>

        <!--FORMULARIO ALTERAR DADOS DO CLIENTE-->
        <div id="dadosCliente"></div>
        <!--FORMULARIO ALTERAR DADOS DO CLIENTE-->

        <?php
        /* LISTAGEM DO PEDIDO DE HOJE */
        if (!empty($_SESSION['pedido'])):
            ?>	
            <h2>Pedidos de Hoje:</h2>
            <table width="800" cellspacing="0">
                <thead>
                    <tr>
                        <td>Pizza Nome</td>
                        <td>Pizza Preço</td>
                        <td>Pizza Quantidade</td>
                        <td>Pizza Subtotal</td>
                        <td>Excluir</td>
                    </tr>
                </thead>
                <tbody>

                    <!--FORMULARIO-->
                <form action="checkout" method="post">
                    <?php
                    $total = "";
                    $d = new ArrayIterator($_SESSION['pedido']);
                    while ($d->valid()):
                        $pedido = pegarPeloId('pizzas', 'pizza_id', $d->key());
                        ?>
                        <tr>
                            <td><?php echo $pedido['pizza_nome']; ?></td>
                            <td>R$ <?php echo number_format($pedido['pizza_preco'], 2, ",", "."); ?></td>
                            <td><?php echo $d->current(); ?></td>
                            <td>R$ <?php echo number_format($d->current() * $pedido['pizza_preco'], 2, ",", "."); ?></td>
                            <td align="center"><a href="http://localhost/pizzaria/cliente/deletar/pizza/<?php echo $pedido['pizza_id']; ?>"><img src="http://localhost/pizzaria/images/delete.gif" width="16" height="16" /></a></td>
                        </tr>			
                        <?php
                        $total += $d->current() * $pedido['pizza_preco'];
                        $d->next();
                    endwhile;
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total do pedido: R$ <?php echo number_format($total, 2, ",", "."); ?></td>
                            <td colspan="1">
                                <input type="submit" name="fechar" value="Fechar Pedido" class="botaoCliente" />
                            </td>
                            <td colspan="3">
                                <a href="http://localhost/pizzaria/cliente/deletar/pedido/" class="botaoCliente">Limpar Pedido</a>
                            </td>
                        </tr>
                    </tfoot>
                </form>
                <!--FORMULARIO-->
            </table>

            <!--MENSAGENS AO ALTERAR DADOS DO CLIENTE-->
            <?php echo isset($erro) ? '<div id="erro">' . $erro . '</div>' : ''; ?>
            <?php echo isset($sucesso) ? '<div id="sucesso">' . $sucesso . '</div>' : ''; ?>
            <!--MENSAGENS AO ALTERAR DADOS DO CLIENTE-->

            <!--SE O CLIENTE NAO TIVER FEITO PEDIDOS HOJE-->
            <?php
        else:
            echo "Você ainda não escolheu nenhuma pizza !";
        endif;
        ?>
        <!--SE O CLIENTE NAO TIVER FEITO PEDIDOS HOJE-->

        <!--RELATORIO DOS PEDIDOS-->
        <div id="relatorioPedidos">
            <h2>Relatório dos pedidos:</h2>
            <table width="800" cellspacing="0">
                <thead>
                    <tr>
                        <th>Pizza</th>
                        <th>Data Pedido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pegar id do cliente para listar pedidos do mesmo
                    $dadosCliente = pegarPeloId('clientes', 'cliente_nome', $_SESSION['nome_cliente']);
                    $idCliente = $dadosCliente['cliente_id'];
                    $listar = listar("pedidos", " inner join pizzas on pedidos.pedidos_pizza = pizzas.pizza_id where pedidos.pedidos_cliente = $idCliente order by pedidos_data DESC");
                    if (!empty($listar)):

                        /* FAZ A PAGINACAO */
                        $params = array(
                            'mode' => 'Sliding',
                            'perPage' => 5,
                            'delta' => 2,
                            'itemData' => $listar
                        );
                        $pager = & Pager::factory($params);
                        $data = $pager->getPageData();

                        /* FAZ A LISTAGEM DOS PEDIDOS */
                        $d = new ArrayIterator($data);
                        while ($d->valid()):
                            if (date('Y-m-d', strtotime($d->current()->pedidos_data)) == date('Y-m-d')):
                                $css = 'hoje';
                            else:
                                $css = 'nao_hoje';
                            endif;
                            ?>
                            <tr class="<?php echo $css; ?>">
                                <td><?php echo $d->current()->pizza_nome; ?></td>
                                <td align="center"><?php echo date('d/m/Y', strtotime($d->current()->pedidos_data)); ?></td>
                            </tr>
                            <?php
                            $d->next();
                        endwhile;
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" align="center">
                                <?php
                                $links = $pager->getLinks();
                                echo $links['all'];
                            else:
                                echo '<tr>';
                                echo '<td colspan="2" align="center">';
                                echo "Nenhum pedido foi feito ainda !";
                                echo '</td>';
                                echo '</tr>';
                            endif;
                            ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!--RELATORIO DOS PEDIDOS-->


        <?php
    else :
        echo "Você não tem permissão para acessar essa área !";
    endif;
    ?>
</div>