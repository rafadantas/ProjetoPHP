<?php


function gravarLogin($cliente) {
    /* ALTERA A DATA PARA A HORA DO LOCALHOST */
    date_default_timezone_set("BRAZIL/EAST");
    $pdo = conectar();
    try {
        $gravarLogin = $pdo->prepare("INSERT INTO dados_login(dados_login_cliente, dados_login_data) VALUES(:cliente, :data)");
        $gravarLogin->bindValue(":cliente", $cliente);
        $gravarLogin->bindValue(":data", date("Y-m-d H:i:s"));
        $gravarLogin->execute();
        //SE CADASTROU NO BANCO DE DADOS O LOGIN DO ADMINISTRADOR
        if ($gravarLogin->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro ao gravar dados de login ";
    }
}


function gravarDados($arquivo) {
    /* ALTERA A DATA PARA A HORA DO LOCALHOST */
    date_default_timezone_set("BRAZIL/EAST");

    /* VERIFICA O TIPO DE ARQUIVO PARA GERAR MENSAGEM */
    if ($arquivo == "functions/login/sucesso_login.txt"):
        $str = "O administrador " . $_SESSION['cliente'] . " logou com sucesso com o IP " . $_SERVER['REMOTE_ADDR'] .
                " na data " . date("d/m/y h:i:s") . "\n";
    else:
        $str = "Erro ao logar com o IP " . $_SERVER['REMOTE_ADDR'] .
                " na data " . date("d/m/y h:i:s") . "\n";
    endif;

    /* GRAVA OS DADOS EM UM ARQUIVO TXT */
    if (file_exists($arquivo)):
        $file = fopen($arquivo, "a");
        if ($file):
            fputs($file, $str);
        endif;
    endif;
}





function logar($login, $senha) {

    $pdo = conectar();
    try {
        $logar = $pdo->prepare("SELECT * FROM clientes WHERE cliente_login = :login AND cliente_senha = :senha");
        $logar->bindValue(":login", $login);
        $logar->bindValue(":senha", $senha);
        $logar->execute();
        $dadosLogin = $logar->fetch(PDO::FETCH_ASSOC);

        if ($logar->rowCount()==1):
            
            $_SESSION['cliente'] = $dadosLogin['cliente_nome'];
            $_SESSION['logado_admin'] = true;

            if (gravarLogin($dadosLogin['cliente_id'])):
                //GRAVA EM UM ARQUIVO TXT
                gravarDados("functions/login/sucesso_login.txt");
                return true;
            endif;

        else:
            //SE NAO CONSEGUIU LOGAR GRAVA EM UM ARQUIVO EXTERNO A TENTATIVA DE LOGIN
            gravarDados("functions/login/erro_login.txt");
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro ao tentar logar no sistema " . $e->getMessage();
    }
}

function verificaLogado($sessao) {
    if (!isset($_SESSION[$sessao])):
        header("Location: ../index.php");
    endif;
}

function logOut(){

}

function pegaIdCliente($nome = null) {

    $pdo = conectar();
    try {
        $pegaId = $pdo->prepare("SELECT * FROM clientes WHERE cliente_nome = :clientes ");
        $pegaId->bindValue(":clientes", $nome);
        $pegaId->execute();
        $dados = $pegaId->fetch(PDO::FETCH_ASSOC);
        return $dados['cliente_id'];
    } catch (PDOException $e) {
        echo "Erro ao pegar ID do cliente " . $e->getMessage();
    }
}

function ultimoLogin($id) {
    $pdo = conectar();
    try {
        $ultimaVisita = $pdo->prepare("SELECT * FROM dados_login WHERE dados_login_cliente = :dados_login 
                                       ORDER BY dados_login_data DESC Limit 1,1");
        $ultimaVisita->bindValue(":dados_login", $id);
        $ultimaVisita->execute();
        $dados = $ultimaVisita->fetch(PDO::FETCH_ASSOC);
        return $dados['dados_login_data'];
    } catch (PDOException $e) {
        echo "Erro ao pegar ID do cliente " . $e->getMessage();
    }
}


?>