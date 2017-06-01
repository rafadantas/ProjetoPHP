<?php

function verificaCadastro($tabela, $nomeCampo, $cadastro) {

    $pdo = conectar();
    try {

        $verificaCadastro = $pdo->prepare("SELECT * FROM $tabela WHERE $nomeCampo = :cadastro");
        $verificaCadastro->bindValue(":cadastro", $cadastro);
        $verificaCadastro->execute();

        if ($verificaCadastro->rowCount() == 1) :
            return false;
        else :
            return true;
        endif;
    } catch (PDOException $e) {
        echo "Erro ao verificar registro cadastrado " . $e->getMessage();
    }
}

function validarCep($cep) {

    global $validou;

    if (preg_match("/^\d{5}-\d{3}$/i", $cep)) :
        return true;
    else :
        $validou = "O formato do cep, não foi aceito !";
    endif;
}

function validarTelefone($telefone) {
    global $validou;

    if (preg_match("/^[(]\d{2}[)]\d{5}-\d{4}$/i", $telefone)) :
        return true;
    else :
        $validou = "O formato do telefone ou celular, não foi aceito !";
    endif;
}

function listar($tabela, $parametros = null) {

    $pdo = conectar();
    try {

        if (is_null($parametros)) :
            $listar = $pdo->prepare("SELECT * FROM " . $tabela);
        else :
            $listar = $pdo->prepare("SELECT * FROM " . $tabela . $parametros);
        endif;
        $listar->execute();

        if ($listar->rowCount() > 0) :
            $dados = $listar->fetchAll(PDO::FETCH_OBJ);
            return $dados;
        else :
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function pegarPeloId($tabela, $campoTabela, $id) {
    $pdo = conectar();
    try {

        $listarDados = $pdo->prepare("SELECT * FROM " . $tabela . " WHERE " . $campoTabela . " = :id");
        $listarDados->bindValue(":id", $id);
        $listarDados->execute();

        if ($listarDados->rowCount() > 0) :
            $dados = $listarDados->fetch(PDO::FETCH_ASSOC);
            return $dados;
        else :
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function buscarPizza($categoria, $pizza) {

    $pdo = conectar();
    try {
        $buscar = $pdo->prepare('SELECT * FROM pizzas WHERE pizza_categoria = :categoria AND pizza_nome LIKE :pizzaDesejada');
        $buscar->bindValue(":categoria", $categoria);
        $buscar->bindValue(":pizzaDesejada", "%".$pizza."%");
        $buscar->execute();

        if ($buscar->rowCount() > 0):
            return $buscar->fetchAll(PDO::FETCH_OBJ);
        else:
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function deletar($id, $tabela, $campoTabela) {
    $pdo = conectar();
    try {
        $deletar = $pdo->prepare("DELETE FROM $tabela WHERE $campoTabela = :id");
        $deletar->bindValue(":id", $id);
        $deletar->execute();

        if ($deletar->rowCount() == 1) :
            return true;
        else :
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function listarBusca($tabela, $campoBusca, $busca) {
    $pdo = conectar();
    try {

        $listarBusca = $pdo->prepare("SELECT * FROM $tabela  WHERE $campoBusca LIKE :b");
        $listarBusca->bindValue(":b", $busca . '%');
        $listarBusca->execute();

        if ($listarBusca->rowCount() > 0) :
            $dados = $listarBusca->fetchAll(PDO::FETCH_ASSOC);
            return $dados;
        else :
            return false;
        endif;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function obrigatorio($nomeCampo, $campo = null) {

    global $obrigatorio;

    if ($campo !== null) :
        if (empty($campo)) :
            $obrigatorio = "O campo $nomeCampo é obrigatório !";
        else :
            $valor = filter_var($campo, FILTER_SANITIZE_STRIPPED);
            return trim($valor);
        endif;
    endif;
}

function enviarEmail($nome, $email, $assunto, $telefone, $mensagem, $cidade) {

    $mail = new PHPMailer();
    //$mail->IsMail();
    $mail->CharSet = "UTF-8";
    $mail->Mailer = "smtp";
    $mail->SMTPSecure = "ssl";
    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = "piccolo@gmail.com";
    $mail->Password = "123";
    $mail->IsHTML(true);

    //EMAIL DE QUEM ESTA ENVIANDO
    $mail->SetFrom($email);

    //NOME PRINCIPAL QUE APARECE AO RECEBER O EMAIL
    $mail->FromName = $nome;

    //ENVIAR UMA COPIA PARA
    $mail->AddAddress('suporteliliosa@gmail.com');
    $mail->AddAddress('suporteliliosa@gmail.com');

    //ASSUNTO DO EMAIL APARECE LOGO ABAIXO DO NOME PRINCIPAL
    $mail->Subject = $assunto;

    //MENSAGEM DO EMAIL
    $mensagemEnviada = "<p>Telefone: $telefone</p>";
    $mensagemEnviada.= "<p>E-mail: $email</p>";
    $mensagemEnviada.= "<p>Cidade: $cidade</p>";
    $mensagemEnviada.=$mensagem;

    $mail->Body = $mensagemEnviada;

    if ($mail->Send()):
        /* CADASTRAR CONTATO NO BANCO */
        return true;
    else:
        return false;
    endif;
}

function verificaCep($cep) {

    $pdo = conectar();
    $verificaCep = $pdo->prepare("SELECT * FROM cep WHERE :cep between cep_inicio and cep_fim");
    $verificaCep->bindValue(':cep', $cep);
    $verificaCep->execute();

    if ($verificaCep->rowCount() == 1):
        $dados = $verificaCep->fetch(PDO::FETCH_OBJ);
        if ($dados->nome != 'SP - INTERIOR'):
            return false;
        else:
            return true;
        endif;
    else:
        return false;
    endif;
}