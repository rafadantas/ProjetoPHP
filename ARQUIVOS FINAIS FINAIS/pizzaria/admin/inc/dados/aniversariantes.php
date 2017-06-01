<?php
if (isset($_GET['ac']) AND $_GET['ac'] == 'gerar'):
    if (isset($_GET['id']) AND $_GET['id'] > 0):

        $cliente = pegarPeloId('clientes', 'cliente_id', $_GET['id']);
        $nomeCliente = $cliente['cliente_nome'];
        
        $dados = array(
            "nome" => "cupom aniversariante ". $nomeCliente,
            "cliente" => $_GET['id'],
            "vencimento" => date("Y-m-d", strtotime("+2days"))
        );

        if (verificaCadastro('cupom', 'cupom_cliente', $_GET['id'])):
            if (cadastrarCupom($dados)):
                $sucesso = "Cupom gerado !";
            else:
                $erro = "Erro ao gerar cupom !";
            endif;
        else:
            $erro = "Ja foi gerado um cupom para esse cliente !";
        endif;
    else:
        $erro = "Escolha um cupom para ser gerado !";
    endif;
endif;
?>
<div id="aniversariantes">

    <h2>Aniversariantes do dia</h2>
    <table width="900" cellspacing="0">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Gerar Cupom</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $hoje = date("m-d");
            $dados = listar("clientes");
            $d = new ArrayIterator($dados);
            while ($d->valid()):
                $c = $d->current();
                $explodeAniversario = explode('-', $c['cliente_nascimento']);
                $aniversarioCliente = $explodeAniversario[1] . "-" . $explodeAniversario[2];

                if ($aniversarioCliente == $hoje):
                    ?>
                    <tr>
                        <td><?php echo $c['cliente_nome']; ?></td>
                        <td align="center"><a href="?p=dados_aniversariantes&id=<?php echo $c['cliente_id']; ?>&ac=gerar">gerar</a></td>
                    </tr>
                    <?php
                endif;
                $d->next();
            endwhile;
            ?>

        </tbody>
    </table>
    <?php echo isset($sucesso) ? '<div id="sucesso">' . $sucesso . '</div>' : ""; ?>
    <?php echo isset($erro) ? '<div id="erro">' . $erro . '</div>' : ""; ?>
</div>