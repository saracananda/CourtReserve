<?php
    require("conexao.php");

    if(isset($_POST['id']) && isset($_POST['senhaadm']) && $conexao != null){ //só entra se existir email, senha e a conexão estiver certinha, ent só usuário que colocou os dados no login consegue acessar essa parte
        $query = $conexao->prepare("SELECT * FROM Administrador WHERE id = ? AND senha = ?"); // procura td de usuário no banco | ? = atribuir valor quando executar
        $query->execute(array($_POST["id"], $_POST["senhaadm"])); //executa | atribui valores que colocamos como ? = 1:email que foi recebido 2:senha que foi recebida
        if ($query->rowCount()){ //row = resultados do select | Count = conta os resultados | if espera true (1), ent nn precisa colocar o 1
            $user = $query->fetchAll(PDO::FETCH_ASSOC)[0]; //fetchAll = pega tudo do array, pode fazer pesquisa que tenha vários resultados, por exemplo | sempre índice 0 (primeiro resultado que aparecer), porque nn tem mais de um usuário com mesmo email e senha
            session_start(); //sessão aberta
            $_SESSION["adm"] = array($user['nome']); // nome da sessão vai ser usuário e vai ter um array com nome de usuário e o adm

            echo json_encode(array("erro" => 0));
        } else {
            echo json_encode(array("erro" => 1, "mensagem" => "Email e/ou senha incorretos.")); //se não encontrar os dados que o usuário digitou | json é um tipo de array similar ao objeto do js
        }
    } else{
        echo json_encode(array("erro" => 1, "mensagem" => "Ocorreu um erro interno no servidor.")); //se nn tiver post (nn tiver recebido dados) manda pra página de formulário de login de novo
    }
?>