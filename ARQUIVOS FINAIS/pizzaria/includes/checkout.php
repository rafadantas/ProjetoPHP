<?php
if (isset($_POST['fecharPedido'])):

    $cep = obrigatorio('cep', $_POST['cep']);
    $pagamento = $_POST['pagamento'];

    global $obrigatorio;

    if (!isset($obrigatorio)):
        //verifica cep
        if (verificaCep($cep)):

            //pegar id do cliente
            $dadosCliente = pegarPeloId('clientes', 'cliente_nome', $_SESSION['nome_cliente']);
            $idCliente = $dadosCliente['cliente_id'];

            //DATA DE HOJE
            $data = date('Y-m-d H:i:s');

            //ID PIZZA
            foreach ($_SESSION['pedido'] as $k => $v):
                $dados = array(
                    'cliente' => $idCliente,
                    'data' => $data,
                    'pagamento' => $pagamento,
                    'pizza' => $k,
                    'status'=>'pendente',
                    'quantidade' =>$v
                );
                if (cadastroPedido($dados)):
                    unset($_SESSION['pedido']);
                    header('Location: http://localhost/pizzaria/cliente');
                else:
                    $erro = 'Erro ao realizar pedido, tente novamente, se o problema persistir, entre em contato com a pizzaria !';
                endif;
            endforeach;

        else:
            $erro = 'Estamos vendendo somente para o Interior de São Paulo';
        endif;

    else:
        $erro = $obrigatorio;
    endif;


endif;


if (isset($_SESSION['logado_cliente'])):

    if (!empty($_SESSION['pedido'])):
        ?>
        <!--INICIO TABELA LISTAGEM DO PEDIDO-->
        <form action="" method="POST">
            <table width="800" cellspacong="0">
                <tr>
                    <td colspan="5" align="center" id="cabecalho_pedido">
                        Seu pedido de hoje:
                    </td>
                </tr>
                <?php
                //FAZER O PEDIDO
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
                <tr>
                    <td>
                        <input type="submit" name="fecharPedido" value="fazer pedido" class="botaoCliente"/><br />
                        <input type="radio" name="pagamento" value="1" checked="checked" />Pagar ao receber a pizza
                        <input type="radio" name="pagamento" value="2" />Pagar ao buscar a pizza<br />
                        CEP <input type="text" name="cep" />
                    </td>
                </tr>
            </table>
        </form>
        <!--FIM TABELA LISTAGEM DO PEDIDO-->

        <!--MENSAGENS AO ALTERAR DADOS DO CLIENTE-->
        <?php echo isset($erro) ? '<div id="erro">' . $erro . '</div>' : ''; ?>
        <?php echo isset($sucesso) ? '<div id="sucesso">' . $sucesso . '</div>' : ''; ?>
        <!--MENSAGENS AO ALTERAR DADOS DO CLIENTE-->


        <?php
    else:
        echo "Você tem que escolher pelo menos uma pizza para fechar o pedido, ou seu pedido ja foi realizado, clique em area do cliente e veja seus pedidos !";
    endif;

else:
    echo "Você tem que estar logado para fechar o pedido, clique em login acima e faça seu login no sistema !";
			endif;
		