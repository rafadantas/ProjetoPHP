<div id="dadosCliente">
    <?php
    if (isset($_GET['id'])):
        $dados = pegarPeloId('clientes', 'cliente_id', $_GET['id']);
        ?>

        <table width="800" cellspacing="0">
            <tr>
                <td>Nome:</td>
                <td><?php echo $dados['cliente_nome']; ?></td>
            </tr>

            <tr>
                <td>Cidade:</td>
                <td><?php echo $dados['cliente_cidade']; ?></td>
            </tr>

            <tr>
                <td>Estado:</td>
                <td><?php echo $dados['cliente_estado']; ?></td>
            </tr>

            <tr>
                <td>Bairro:</td>
                <td><?php echo $dados['cliente_bairro']; ?></td>
            </tr>

            <tr>
                <td>Cep:</td>
                <td><?php echo $dados['cliente_cep']; ?></td>
            </tr>

            <tr>
                <td>Telefone</td>
                <td><?php echo $dados['cliente_telefone']; ?></td>
            </tr>

            <tr>
                <td>Celular:</td>
                <td><?php echo $dados['cliente_celular']; ?></td>
            </tr>

            <tr>
                <td>E-mail:</td>
                <td><?php echo $dados['cliente_email']; ?></td>
            </tr>

            <tr>
                <td>Endereço:</td>
                <td><?php echo $dados['cliente_endereco']; ?></td>
            </tr>

        </table>

        <?php
    else:
        echo "Você não escolheu um cliente para ver os dados !";
    endif;
    ?>
</div>