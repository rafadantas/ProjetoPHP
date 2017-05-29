<h2>
    Pagina Inicial do Sistema Administrativo
</h2>
<div id="bemvindo">
    <p>
        <?php $id = pegaIdCliente($_SESSION['cliente']); ?>
        Bem vindo <?php echo $_SESSION['cliente']; ?>, seu último login foi em: <?php echo date("d/m/Y" ,strtotime(ultimoLogin($id)));?>
    </p>
</div>