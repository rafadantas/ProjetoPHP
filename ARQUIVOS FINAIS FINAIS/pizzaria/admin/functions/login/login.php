<?php

function gravarLogin($administrador) {
    /* ALTERA A DATA PARA A HORA DO LOCALHOST */
    date_default_timezone_set("BRAZIL/EAST");
    $pdo = conectar();
    try {
        $gravarLogin = $pdo->prepare("INSERT INTO dados_login_administrador(dados_login_administrador, dados_login_administrador_data) VALUES(:administrador, :data)");
        $gravarLogin->bindValue(":administrador", $administrador);
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
        $logar = $pdo->prepare("SELECT * FROM administrador WHERE administrador_login = :login AND administrador_senha = :senha");
        $logar->bindValue(":login", $login);
        $logar->bindValue(":senha", $senha);
        $logar->execute();
        $dadosLogin = $logar->fetch(PDO::FETCH_ASSOC);

        if ($logar->rowCount()==1):
            //SE LOGOU CRIA AS SESSOES            
            $_SESSION['administrador'] = $dadosLogin['administrador_nome'];
            $_SESSION['administrador_id'] = $dadosLogin['administrador_id'];
            $_SESSION['logado_admin'] = true;
            
            //GRAVA OS DADOS DE LOGIN NO BANCO DE DADOS
            if (gravarLogin($dadosLogin['administrador_id'])):
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

function pegaIdAdministrador($nome = null) {

    $pdo = conectar();
    try {
        $pegaId = $pdo->prepare("SELECT * FROM administrador WHERE administrador_nome = :administrador ");
        $pegaId->bindValue(":administrador", $nome);
        $pegaId->execute();
        $dados = $pegaId->fetch(PDO::FETCH_ASSOC);
        return $dados['administrador_id'];
    } catch (PDOException $e) {
        echo "Erro ao pegar ID do cliente " . $e->getMessage();
    }
}

function ultimoLogin($id) {
    $pdo = conectar();
    try {
        $ultimaVisita = $pdo->prepare("SELECT * FROM dados_login_administrador WHERE dados_login_administrador = :dados_login 
                                       ORDER BY dados_login_administrador_data DESC Limit 1,1");
        $ultimaVisita->bindValue(":dados_login", $id);
        $ultimaVisita->execute();
        $dados = $ultimaVisita->fetch(PDO::FETCH_ASSOC);
        return $dados['dados_login_administrador_data'];
    } catch (PDOException $e) {
        echo "Erro ao pegar ID do cliente " . $e->getMessage();
    }
}


?>